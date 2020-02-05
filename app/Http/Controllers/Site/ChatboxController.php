<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class ChatboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('site.chatbox.index');
    }
}
