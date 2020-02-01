<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserMade1000BonusTransation;
use App\Achievements\UserMade100BonusTransation;
use App\Achievements\UserMade200BonusTransation;
use App\Achievements\UserMade300BonusTransation;
use App\Achievements\UserMade400BonusTransation;
use App\Achievements\UserMade500BonusTransation;
use App\Achievements\UserMade50BonusTransaction;
use App\Achievements\UserMade600BonusTransation;
use App\Achievements\UserMade700BonusTransation;
use App\Achievements\UserMade800BonusTransation;
use App\Achievements\UserMade900BonusTransation;
use App\Achievements\UserMadeFirtBonusTransation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\BonusDonateRequest;
use App\Models\Bonus;
use App\Models\UserBonus;
use App\Models\Vip;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $points = Bonus::where('is_enabled', '=', true)->get();
        return view('site.bonus.bonus', compact('points'));
    }

    public function stats()
    {
        return view('site.bonus.stats');
    }

    public function gifts(Request $request)
    {
        $user = $request->user();

        $transactions = UserBonus::with(['user:id,username,slug', 'member:id,username,slug'])->where(function ($query) use ($user) {
            $query->where('user_id', '=', $user->id)->orwhere('member_id', '=', $user->id);
        })->where('bonus_id', '=', 1)->orderBy('created_at', 'DESC')->paginate(30);

        $sent = UserBonus::where('user_id', '=', $user->id)->where('bonus_id', '=', 1)->sum('cost');
        $received = UserBonus::where('member_id', '=', $user->id)->where('bonus_id', '=', 1)->sum('cost');

        return view('site.bonus.gifts', compact('transactions', 'sent', 'received'));
    }

    public function donates()
    {
        $members = User::select('id', 'username')
            ->where('id', '!=', auth()->user()->id)
            ->whereNotIn('status', [0, 2, 3])
            ->get()
            ->pluck('username', 'id');

        return view('site.bonus.donates', compact('members'));
    }

    public function exchange(Request $request, $bonus_id)
    {
        $user = $request->user();
        $point = Bonus::where('id', '=', $bonus_id)->firstOrFail();

        if ($user->points >= $point->cost) {
            $try = $this->doItemExchange($user->id, $bonus_id);
            if (!$try) {
                toastr()->warning('Infelizmente não foi possivel realizado a troca!', 'Aviso');
                return redirect()->to('bonus');
            }

            $user->points -= $point->cost;
            $user->save();

            // Achievements
            $this->achievement($user);

        } else {
            toastr()->warning('Infelizmente não foi possivel realizado a troca!', 'Aviso');
            return redirect()->to('bonus');
        }

        toastr()->info('Troca realizada com sucesso!', 'Aviso');
        return redirect()->to('bonus');
    }

    private function doItemExchange($user_id, $point_id)
    {
        $data = new Carbon();
        $item = Bonus::where('id', '=', $point_id)->first();

        $user = User::findOrFail($user_id);

        $freeleecher = Vip::where('user_id', '=', $user->id)->first();

        if ($item->bonus_type == 0) {
            if ($user->downloaded >= $item->quantity) {
                $user->downloaded -= $item->quantity;
                $user->update();
            } else {
                return false;
            }

        } elseif ($item->bonus_type == 1) {

            $user->uploaded += $item->quantity;
            $user->update();

        } elseif ($item->bonus_type == 2) {

            if (!$freeleecher) {
                $freeleech = new Vip();
                $freeleech->user_id = $user->id;
                $freeleech->is_freeleech = true;
                $freeleech->is_active = true;
                $freeleech->expires_on = $data->addDays($item->quantity);
                $freeleech->save();

                //change user group
                $user->group_id = 6;
                $user->update();
            } else {
                return false;
            }

        } elseif ($item->bonus_type == 3) {

            if ($user->warned == true) {
                $user->warned = false;
                $user->update();
                DB::table('moderates')
                    ->where('user_id', '=', $user->id)
                    ->update(['is_enabled' => false, 'expires_on' => null]);
            } else {
                return false;
            }

        } elseif ($item->bonus_type == 4) {

            $user->invites += $item->quantity;
            $user->update();

        } elseif ($item->bonus_type == 5) {

            $user->max_slots += $item->quantity;
            $user->update();

        }

        $transation = new UserBonus();
        $transation->bonus_id = $item->id;
        $transation->user_id = 1;
        $transation->member_id = $user->id;
        $transation->cost = $item->cost;
        $transation->description = $item->name;
        $transation->save();

        return true;
    }

    public function donate(BonusDonateRequest $request)
    {
        $member_id = $request->input('user_id');
        $quantity = $request->input('quantity');

        $user = $request->user();

        if ($user->points >= $quantity) {

            $exchange = new UserBonus();
            $exchange->bonus_id = 1;
            $exchange->user_id = $user->id;
            $exchange->member_id = $member_id;
            $exchange->cost = $quantity;
            $exchange->description = 'Doou seu pontos';
            $exchange->save();

            //subtrai os pontos do usuario logado
            $user->points -= $quantity;
            $user->update();

            //adiciona o pontos ao membro
            $member = User::where('id', '=', $member_id)->first();
            $member->points += $quantity;
            $member->update();

            // Achievements
            $this->achievement($user);

        } else {
            toastr()->warning('Voce nao possui pontos suficientes', 'Aviso');
            return redirect()->to('bonus');
        }

        toastr()->success('Troca realizada com sucesso!', 'Bonus');
        return redirect()->to('bonus');
    }

    private function achievement(User $user)
    {
        // Achievements
        $user->unlock(new UserMadeFirtBonusTransation());
        $user->addProgress(new UserMade50BonusTransaction(), 1);
        $user->addProgress(new UserMade100BonusTransation(), 1);
        $user->addProgress(new UserMade200BonusTransation(), 1);
        $user->addProgress(new UserMade300BonusTransation(), 1);
        $user->addProgress(new UserMade400BonusTransation(), 1);
        $user->addProgress(new UserMade500BonusTransation(), 1);
        $user->addProgress(new UserMade600BonusTransation(), 1);
        $user->addProgress(new UserMade700BonusTransation(), 1);
        $user->addProgress(new UserMade800BonusTransation(), 1);
        $user->addProgress(new UserMade900BonusTransation(), 1);
        $user->addProgress(new UserMade1000BonusTransation(), 1);
    }
}
