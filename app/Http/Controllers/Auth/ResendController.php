<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendActivationJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResendController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function resend()
    {
        return view('auth.resend');
    }

    public function resendEmail(Request $request)
    {
        $email = $request->input('email');

        $user = DB::table('users')
            ->select('status', 'email', 'code', 'disabled_at', 'created_at')
            ->where('email', '=', $email)
            ->first();

//        $current = Carbon::now();
//        if ($user->status == 1 AND !empty($user->code) AND $user->created_at < $current->copy()->subMinutes(30)->toDateTimeString()) {
//            return view('auth.resend')
//                ->with('info', 'Você precisa esperar 30min após o cadastro, nosso sistema ainda vai efetuar 3 tentativas.');
//        }

        if ($user->status == 1) {
            //resend email activation to new member
            $this->dispatch(new SendActivationJob($user->email, $user->code));
            return view('auth.resend')->with('warning', 'Um novo e-mail foi enviado para ativação!');
        }

        if ($user->status == 2) {
            return redirect()->to('login');
        }

        if ($user->status == 3) {
            return view('auth.resend')->with('info', 'Conta suspensa, tente novamente em outro dia!');
        }

        if ($user->status == 4) {
            $date = format_date($user->disabled_at);
            return view('auth.resend')->with('danger', 'Conta banida dia: ' . $date);
        }

        return redirect()->route('resend');
    }
}
