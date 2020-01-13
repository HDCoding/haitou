<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserChangeAvatar;
use App\Achievements\UserChangePrivacies;
use App\Achievements\UserChangeSettings;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateAccount;
use App\Http\Requests\User\UpdateEmail;
use App\Http\Requests\User\UpdatePassword;
use App\Http\Requests\User\UpdatePrivacy;
use App\Http\Requests\User\UpdateSetting;
use App\Mail\AccountEmailUpdate;
use App\Mail\PasswordNotification;
use App\Models\Mood;
use App\Models\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile($slug)
    {
        $member = User::whereSlug($slug)->firstOrFail();
        $member->increment('views');

        return view('site.users.profile', compact('member'));
    }

    public function formAccount()
    {
        $states = State::all()->pluck('name', 'id');
        $moods = Mood::all()->pluck('name', 'id');

        return view('site.users.update.account', compact('states', 'moods'));
    }

    public function postAccount(UpdateAccount $request)
    {
        $user = $request->user();

        $user->state_id = $request->input('state_id');
        $user->mood_id = $request->input('mood_id');
        $avatar = $request->input('avatar');
        $user->avatar = $avatar;
        $user->cover = $request->input('cover');
        $user->birthday = $request->input('birthday');
        $user->info = $request->input('info');
        $user->signature = $request->input('signature');
        $user->update();

        // Achievement
        if (!empty($avatar)) {
            $user->unlock(new UserChangeAvatar());
        }

        return redirect()->route('edit.profile');
    }

    public function formPassword()
    {
        return view('site.users.update.password');
    }

    public function postPassword(UpdatePassword $request)
    {
        $user = $request->user();

        if (Hash::check($request->input('senha'), $user->password)) {
            $user->password = Hash::make($request->input('password'));
            $user->update();
        }

        //envia o email para o novo membro informando alteração de senha
        Mail::to($user)->send(new PasswordNotification());

        return redirect()->route('edit.password');
    }

    public function formPrivacy()
    {
        return view('site.users.update.privacies');
    }

    public function postPrivacy(UpdatePrivacy $request)
    {
        $user = $request->user();


        $user->show_achievements = $request->input('show_achievements') ? true : false;
        $user->show_mood = $request->input('show_mood') ? true : false;
        $user->show_state = $request->input('show_state') ? true : false;
        $user->show_group = $request->input('show_group') ? true : false;
        $user->show_downloaded = $request->input('show_downloaded') ? true : false;
        $user->show_uploaded = $request->input('show_uploaded') ? true : false;
        $user->show_profile = $request->input('show_profile') ? true : false;
        $user->show_profile_points = $request->input('show_profile_points') ? true : false;
        $user->show_profile_level = $request->input('show_profile_level') ? true : false;
        $user->show_profile_avatar = $request->input('show_profile_avatar') ? true : false;
        $user->show_profile_cover = $request->input('show_profile_cover') ? true : false;
        $user->show_profile_info = $request->input('show_profile_info') ? true : false;
        $user->show_profile_title = $request->input('show_profile_title') ? true : false;
        $user->show_profile_signature = $request->input('show_profile_signature') ? true : false;
        $user->show_profile_birthday = $request->input('show_profile_birthday') ? true : false;
        $user->show_profile_social_links = $request->input('show_profile_social_links') ? true : false;
        $user->show_profile_warning = $request->input('show_profile_warning') ? true : false;
        $user->show_forum_signatures = $request->input('show_forum_signatures') ? true : false;
        $user->save();

        // Achievement
        $user->unlock(new UserChangePrivacies());

        return redirect()->route('edit.privacy');
    }

    public function formSocial()
    {
        return view('site.users.update.social');
    }

    public function postSocial(UpdateSetting $request)
    {
        $user = $request->user();

        $user->facebook = $request->input('facebook');
        $user->twitter = $request->input('twitter');
        $user->linkedin = $request->input('linkedin');
        $user->instagram = $request->input('instagram');
        $user->pinterest = $request->input('pinterest');
        $user->torrents_per_page = $request->input('torrents_per_page');
        $user->topics_per_page = $request->input('topics_per_page');
        $user->posts_per_page = $request->input('posts_per_page');
        $user->receive_email = $request->input('receive_email') ? true : false;
        $user->save();

        // Achievement
        $user->unlock(new UserChangeSettings());

        return redirect()->route('edit.social');
    }

    public function formPasskey()
    {
        return view('site.users.update.passkey');
    }

    public function postPasskey(Request $request)
    {
        $user = $request->user();

        if ($request->isMethod('POST')) {
            $user->passkey = md5_gen();
            $user->update();
        }
        return redirect()->route('edit.passkey');
    }

    public function formEmail()
    {
        return view('site.users.update.email');
    }

    public function postEmail(UpdateEmail $request)
    {
        //usuario autenticado
        $user = $request->user();
        //Código para ativação da conta
        $token = sha1_gen();
        //recebe o email novo
        $email = $request->input('email');
        //atualiza no banco
        $user->email = $email;
        $user->status = 0;
        $user->code = $token;
        $user->update();

        //envia o email para o novo membro
        Mail::to($user)->send(new AccountEmailUpdate($token));
        //desloga o usuario
        $request->session()->flush();
        auth()->logout();
        //Redireciona para o login e informa que precisa ativar a conta novamente
        return view('auth.activation')
            ->with('info', 'E-mail alterado com sucesso, ative sua conta novamente com novo e-mail inserido!');
    }
}
