<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\NetworkInformation;
use App\Http\Controllers\Controller;

class TrafficsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:acesso-total');
    }

    public function index(NetworkInformation $information)
    {
        $data = $information->data();
        return view('staff.traffics.index', compact('data'));
    }

    public function hourly(NetworkInformation $information)
    {
        $hourly = $information->hourly('eth1');
        return view('staff.traffics.hourly', compact('hourly'));
    }

    public function daily(NetworkInformation $information)
    {
        $daily = $information->daily('eth1');
        return view('staff.traffics.daily', compact('daily'));
    }

    public function monthly(NetworkInformation $information)
    {
        $monthly = $information->monthly('eth1');
        return view('staff.traffics.monthly', compact('monthly'));
    }

    public function topten(NetworkInformation $information)
    {
        $topten = $information->topten('eth1');
        return view('staff.traffics.top10', compact('topten'));
    }
}
