<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\FailedLogin;
use Illuminate\Http\Request;

class FailedLoginsController extends Controller
{
    public function index()
    {
        $attempts = FailedLogin::with('user:id,name')->latest()->paginate(25);
        return view('staff.failed_logins.index', compact('attempts'));
    }
}
