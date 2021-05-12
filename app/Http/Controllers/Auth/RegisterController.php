<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\SendActivationJob;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegisterRequest $request
     * @return User
     */
    protected function register(RegisterRequest $request): User
    {
        $points = setting('points_signup');

        //Account activation code
        $code = sha1_gen();

        $email = $request->input('email');

        //Create new user account
        $user = new User();
        $user->group_id = 1;
        $user->username = $request->input('username');
        $user->email = strtolower($email);
        $user->password = Hash::make($request->input('password'));
        $user->state_id = 25;
        $user->points = $points;
        $user->experience = $points;
        $user->passkey = md5_gen();
        $user->birthday = Carbon::today();
        $user->mood_id = 1;
        $user->code = $code;
        $user->save();

        //send email activation to new member
        $this->dispatch(new SendActivationJob($email, $code));

        //informs that the account was created
        return view('auth.activation')
            ->with('info', 'Conta criada com sucesso, verifique seu e-mail para ativar sua conta, Caixa de Entrada ou SPAM.');
    }
}
