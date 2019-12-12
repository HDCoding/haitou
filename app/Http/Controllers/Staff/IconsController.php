<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;

class IconsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fontawesome()
    {
        return view('staff.icons.fontawesome');
    }

    public function ionicons()
    {
        return view('staff.icons.ionicons');
    }

    public function linearicons()
    {
        return view('staff.icons.linearicons');
    }

    public function openiconic()
    {
        return view('staff.icons.openiconic');
    }

    public function strokeicons()
    {
        return view('staff.icons.strokeicons');
    }
}
