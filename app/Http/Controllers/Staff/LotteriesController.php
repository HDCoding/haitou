<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;

class LotteriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:sorteios-mod');
    }

    public function index()
    {
        return view('staff.lotteries.index');
    }
}
