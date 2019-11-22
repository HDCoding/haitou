<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\AccountActivation;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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

    protected $points;

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
        $this->points = setting('points_signup');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegisterRequest $request
     * @return \App\User
     */
    protected function register(RegisterRequest $request)
    {
        $points = $this->points;

        //Account activation code
        $code = sha1_gen();

        //Create new user account
        $user = new User();
        $user->role_id = 1;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->state_id = 25;
        $user->points += $points;
        $user->experience += $points;
        $user->passkey = md5_gen();
        $user->birthday = Carbon::today();
        $user->mood_id = 1;
        $user->code = $code;
        $user->save();

        //send email to new member
        Mail::to($user)->send(new AccountActivation($code));

        //informs that the account was created
        return view('auth.activation')
            ->with('info', 'Conta criada com sucesso, verifique seu e-mail para ativar sua conta, Caixa de Entrada ou SPAM.');
    }
}
