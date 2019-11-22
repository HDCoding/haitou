<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AccountThanksActivation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ActivationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function newAccount(string $code)
    {
        $user = User::where('code', '=', $code)->first();

        if ($user) {
            //Confirm and activate account
            //Update User status
            $user->status = 1;
            $user->activated_at = now();
            $user->code = null;
            //update user account
            $user->save();
            //Send thank-you email
            Mail::to($user)->send(new AccountThanksActivation());

            //Return to confirmation page
            return view('auth.activation')->with('info', 'Conta ativada com sucesso, agora você pode fazer o login.');
        } else {
            return redirect()->to('login', ['info' => 'Chave de ativação não existe ou conta já ativada.']);
        }
    }

    public function updateEmail(string $code)
    {
        $user = User::where('code', '=', $code)->first();

        if ($user) {
            //Confirm and re-activate account
            $user->status = 1;
            //update user account
            $user->save();

            //Return to confirmation page
            return view('auth.activation')->with('info', 'Conta ativada com sucesso, agora você pode fazer o login.');
        } else {
            return redirect()->to('login', ['info' => 'Chave de ativação não existe ou conta já ativada.']);
        }
    }
}
