<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;

class IconsController extends Controller
{
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

    public function openIconic()
    {
        return view('staff.icons.open-iconic');
    }

    public function peIcon7Stroke()
    {
        return view('staff.icons.pe-icon-7-stroke');
    }
}
