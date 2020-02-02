<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\NetworkInformation;
use App\Http\Controllers\Controller;

class TrafficsController extends Controller
{
    protected $vnstat;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:acesso-total');
        $this->vnstat = new NetworkInformation();
    }

    public function index()
    {
        $data = $this->vnstat->data();
        return view('staff.traffics.index', compact('data'));
    }

    public function hourly()
    {
        $hourly = $this->vnstat->hourly('ens4');
        return view('staff.traffics.hourly', compact('hourly'));
    }

    public function daily()
    {
        $daily = $this->vnstat->daily('ens4');
        return view('staff.traffics.daily', compact('daily'));
    }

    public function monthly()
    {
        $monthly = $this->vnstat->monthly('ens4');
        return view('staff.traffics.monthly', compact('monthly'));
    }

    public function topten()
    {
        $topten = $this->vnstat->topten('ens4');
        return view('staff.traffics.top10', compact('topten'));
    }
}
