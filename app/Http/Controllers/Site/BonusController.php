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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
{
    public function index()
    {
        $points = Bonus::where('is_enabled', '=', true)->get();
        $members = User::select('id', 'name')->get()->pluck('name', 'id');

        return view('site.bonus.index', compact('points', 'members'));
    }

    public function store(Request $request)
    {
        $bonus_id = $request->input('bonus_id');

        $point = Bonus::where('id', '=', $bonus_id)->firstOrFail();
        $user = $request->user();

        if ($user->points >= $point->cost) {
            $try = $this->exchange($user->id, $bonus_id);
            if (!$try) {
                toastr()->warning('Infelizmente não foi possivel realizado a troca!');
                return redirect()->to('bonus');
            }

            $user->points -= $point->cost;
            $user->points_used += $point->cost;
            $user->save();

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

        } else {
            toastr()->warning('Infelizmente não foi possivel realizado a troca!', 'Aviso');
            return redirect()->to('bonus');
        }

        toastr()->info('Troca realizada com sucesso!', 'Aviso');
        return redirect()->to('bonus');
    }

    public function exchange($user_id, $point_id)
    {
        $data = now();
        $item = Bonus::where('id', '=', $point_id)->first();
        $user = User::findOrFail($user_id);

        $freeleecher = VipUser::where('user_id', '=', $user->id)->first();

        $transation = new UserBonus();

        if ($item->bonus_type == 0) {
            if ($user->downloaded >= $item->quantity) {
                $user->downloaded -= $item->quantity;
                $user->save();
            } else {
                return false;
            }
        } elseif ($item->bonus_type == 1) {
            $user->uploaded += $item->quantity;
            $user->save();
        } elseif ($item->bonus_type == 2) {
            if (!$freeleecher) {
                $freeleech = new Vip();
                $freeleech->user_id = $user->id;
                $freeleech->is_freeleech = true;
                $freeleech->is_active = true;
                $freeleech->expires_on = $data->addDays($item->quantity);
                $freeleech->save();
            } else {
                return false;
            }
        } elseif ($item->bonus_type == 3) {
            if ($user->warned == true) {
                $user->warned = false;
                $user->save();
                DB::table('moderated_users')->where('user_id', '=', $user->id)->update(['is_enabled' => false, 'expires_on' => null]);
                DB::table('users')->where('id', '=', $user->id)->update(['is_warned' => false]);
            } else {
                return false;
            }
        } elseif ($item->bonus_type == 4) {
            $user->invites += $item->quantity;
            $user->save();
        } elseif ($item->bonus_type == 5) {
            $user->maxslots += $item->quantity;
            $user->save();
        }

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
            $exchange->user_id = $user->id;
            $exchange->member_id = $member_id;
            $exchange->cost = $quantity;
            $exchange->description = 'Doou seu pontos';
            $exchange->save();

            //subtrai os pontos do usuario logado
            $user->points -= $quantity;
            $user->save();

            //adiciona o pontos ao membro
            $member = User::where('id', '=', $member_id)->first();
            $member->points += $quantity;
            $member->save();

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

        } else {
            toastr()->warning('Infelizmente não foi possivel realizado a troca! Voce nao possui pontos suficientes', 'Aviso');
            return redirect()->to('bonus');
        }

        toastr()->success('Troca realizada com sucesso!', 'Bonus');
        return redirect()->to('bonus');
    }
}
