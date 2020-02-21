<?php

namespace App\Http\Controllers\Auth;

use App\Achievements\UserMade1000Invites;
use App\Achievements\UserMade100Invites;
use App\Achievements\UserMade200Invites;
use App\Achievements\UserMade300Invites;
use App\Achievements\UserMade400Invites;
use App\Achievements\UserMade500Invites;
use App\Achievements\UserMade50Invites;
use App\Achievements\UserMade600Invites;
use App\Achievements\UserMade700Invites;
use App\Achievements\UserMade800Invites;
use App\Achievements\UserMade900Invites;
use App\Achievements\UserMadeFirstInvite;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\InvitationRequest;
use App\Jobs\SendActivationThanksMail;
use App\Models\Invitation;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function code(string $code)
    {
        $invitation = Invitation::where('code', '=', $code)->first();

        if ($invitation) {
            return view('auth.invitation', compact('code'));
        } else {
            return view('auth.activation')->with('warning', 'Codigo de convite invalido ou expirado');
        }
    }

    public function register(InvitationRequest $request)
    {
        if ($request->isMethod('post')) {
            $code = $request->input('code');
            $invitation = Invitation::where('code', '=', $code)->first();

            if (!$invitation) {
                return redirect()->back()->with('warning', 'Não altere o código de convite!')->withInput();
            }

            //Points
            $signup = setting('points_signup');
            $invite = setting('points_invite');

            $points = $signup + $invite;

            //Adicionar usuario convidado ao banco
            $user = new User();
            $user->group_id = 1;
            $user->username = $request->input('username');
            $user->email = $invitation->email;
            $user->password = Hash::make($request->input('password'));
            $user->status = 2;
            $user->mood_id = 1;
            $user->state_id = 25;
            $user->invites = 10;
            $user->points = $points;
            $user->experience = $points;
            $user->passkey = md5_gen();
            $user->birthday = Carbon::today();
            $user->activated_at = Carbon::now();
            $user->save();

            //Set user permissions
            $user->allows()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 11]);

            //send thank you email
            $this->dispatch(new SendActivationThanksMail($user));

            //update the invitation
            $invitation->accepted_by = $user->id;
            $invitation->code = null;
            $invitation->accepted = true;
            $invitation->expires_on = null;
            $invitation->accepted_at = now();
            $invitation->save();

            //Send points to friend whos have invited
            $friend = User::where('id', '=', $invitation->user_id)->first();
            $friend->invites += 3;
            $friend->points += $points;
            $friend->experience += $points;
            $friend->num_invite += 1; //increment number of invites
            $friend->save();

            // Achievements
            $this->achievement($friend);

            return view('auth.activation')
                ->with('info', 'Conta criada e ativada com sucesso, agora você pode fazer login.');
        } else {
            return redirect()->to('login');
        }
    }

    private function achievement(User $user)
    {
        // Achievements
        $user->unlock(new UserMadeFirstInvite());
        $user->addProgress(new UserMade50Invites(), 1);
        $user->addProgress(new UserMade100Invites(), 1);
        $user->addProgress(new UserMade200Invites(), 1);
        $user->addProgress(new UserMade300Invites(), 1);
        $user->addProgress(new UserMade400Invites(), 1);
        $user->addProgress(new UserMade500Invites(), 1);
        $user->addProgress(new UserMade600Invites(), 1);
        $user->addProgress(new UserMade700Invites(), 1);
        $user->addProgress(new UserMade800Invites(), 1);
        $user->addProgress(new UserMade900Invites(), 1);
        $user->addProgress(new UserMade1000Invites(), 1);
    }
}
