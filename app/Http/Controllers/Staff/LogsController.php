<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('staff.logs.index');
    }
}
