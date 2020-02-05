<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LockscreenRequest;
use Illuminate\Support\Facades\Hash;

class LockscreenController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lockscreen');
    }

    public function lock()
    {
        if (!session()->has('locked')) {
            session()->put('locked', [
                'status' => true,
                'page' => url()->previous()
            ]);
        }

        return view('auth.lockscreen');
    }

    public function unlock(LockscreenRequest $request)
    {
        $check = Hash::check($request->input('password'), $request->user()->password);

        if (!$check) {
            return redirect()->route('lockscreen')->withErrors(['Sua senha não corresponde ao seu perfil.']);
        }

        $lock = $this->getLock();

        session()->put('locked', [
            'status' => false,
            'page' => ''
        ]);

        return redirect()->to($lock['page']);
    }

    public function getLock()
    {
        return session()->get('locked');
    }
}
