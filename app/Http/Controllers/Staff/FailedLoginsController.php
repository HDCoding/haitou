<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\FailedLogin;

class FailedLoginsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:falhas-login-mod');
    }

    public function index()
    {
        $attempts = FailedLogin::with('user:id,username')->latest()->paginate(25);
        return view('staff.failedlogins.index', compact('attempts'));
    }
}
