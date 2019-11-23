<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class DonatesController extends Controller
{
    public function index()
    {
        return view('site.donates.index');
    }
}
