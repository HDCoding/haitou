<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\FailedLogin;
use Illuminate\Http\Request;

class FailedLoginsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $attempts = FailedLogin::with('user:id,name')->latest()->paginate(25);
        return view('staff.failedlogins.index', compact('attempts'));
    }
}
