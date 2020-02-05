<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserChangeAvatar;
use App\Achievements\UserChangePrivacies;
use App\Achievements\UserChangeSettings;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateAccount;
use App\Http\Requests\User\UpdateAvatar;
use App\Http\Requests\User\UpdateCover;
use App\Http\Requests\User\UpdateEmail;
use App\Http\Requests\User\UpdatePassword;
use App\Http\Requests\User\UpdatePrivacy;
use App\Http\Requests\User\UpdateSetting;
use App\Jobs\SendEmailUpdatedMail;
use App\Jobs\SendPasswordNotificationMail;
use App\Models\Log;
use App\Models\Login;
use App\Models\Mood;
use App\Models\Post;
use App\Models\State;
use App\Models\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $user->birthday = $request->input('birthday');
        $user->info = $request->input('info');
        $user->signature = $request->input('signature');
        $user->update();
        return redirect()->route('edit.profile');
    }

    public function postAvatar(UpdateAvatar $request)
    {
        $user = $request->user();

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = md5_gen();

            // Recupera a extensão do arquivo
            $extension = $request->avatar->extension();

            // Define finalmente o nome
            $name_file = "{$user->id}.{$name}.{$extension}";

            // Faz o upload
            $upload = $request->avatar->storeAs('avatars', $name_file, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/avatars/nomedinamicoarquivo.extensao

            if (!$upload) {
                return redirect()->route('edit.profile')
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                $user->avatar = $name_file;
                // Achievement
                $user->unlock(new UserChangeAvatar());
            }
        } else {
            return redirect()->route('edit.profile')
                ->with('error', 'Erro no arquivo de imagem, check o arquivo e tente novamente.')
                ->withInput();
        }

        $user->update();
        return redirect()->route('edit.profile');
    }

    public function postCover(UpdateCover $request)
    {
        $user = $request->user();

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = md5_gen();

            // Recupera a extensão do arquivo
            $extension = $request->cover->extension();

            // Define finalmente o nome
            $name_file = "{$user->id}.{$name}.{$extension}";

            // Faz o upload
            $upload = $request->cover->storeAs('covers', $name_file, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/covers/nomedinamicoarquivo.extensao

            if (!$upload) {
                return redirect()->route('edit.profile')
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                $user->cover = $name_file;
                // Achievement
                $user->unlock(new UserChangeAvatar());
            }
        } else {
            return redirect()->route('edit.profile')
                ->with('error', 'Erro no arquivo de imagem, check o arquivo e tente novamente.')
                ->withInput();
        }

        $user->update();
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
        $this->dispatch(new SendPasswordNotificationMail($user));

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

        //send email to update email account
        $this->dispatch(new SendEmailUpdatedMail($user, $token));

        //desloga o usuario
        $request->session()->flush();
        auth()->logout();
        //Redireciona para o login e informa que precisa ativar a conta novamente
        return view('auth.activation')
            ->with('info', 'E-mail alterado com sucesso, ative sua conta novamente com novo e-mail inserido!');
    }

    public function topics(Request $request)
    {
        $user = $request->user();
        $topics = Topic::with('forum:id,name,slug')
            ->where('topics.first_post_user_id', '=', $user->id)
            ->latest()
            ->paginate(25);

        return view('site.users.topics', compact('topics'));
    }

    public function posts(Request $request)
    {
        $user = $request->user();
        $posts = Post::with(['topic', 'user'])
            ->selectRaw('posts.id as id, posts.*')
            ->leftJoin('topics', 'posts.topic_id', '=', 'topics.id')
            ->where('posts.user_id', '=', $user->id)
            ->orderBy('posts.created_at', 'desc')
            ->paginate(25);

        return view('site.users.posts', compact('posts'));
    }

    public function achievements($slug)
    {
        $member = User::whereSlug($slug)->firstOrFail();

        return view('site.users.achievements', compact('member'));
    }

    public function logs($slug)
    {
        abort_unless(auth()->user()->can('acesso-total'), 403);
        $member = User::whereSlug($slug)->firstOrFail();
        $logs = Log::where('user_id', '=', $member->id)->orderBy('id', 'DESC')->get();

        return view('site.users.logs', compact('member', 'logs'));
    }

    public function logins($slug)
    {
        abort_unless(auth()->user()->can('acesso-total'), 403);
        $member = User::whereSlug($slug)->firstOrFail();
        $logins = Login::where('user_id', '=', $member->id)->orderBy('id', 'DESC')->get();

        return view('site.users.logins', compact('member', 'logins'));
    }
}
