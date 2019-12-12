<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\NetwordInformation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrafficsController extends Controller
{
    protected $vnstat;

    public function __construct()
    {
        $this->middleware('auth');
        $this->vnstat = new NetwordInformation();
    }

    public function index()
    {
        $data = $this->vnstat->data();
        return view('staff.traffics.index', compact('data'));
    }

    public function hourly()
    {
        $hourly = $this->vnstat->hourly('eth1');
        return view('staff.traffics.hourly', compact('hourly'));
    }

    public function daily()
    {
        $daily = $this->vnstat->daily('eth1');
        return view('staff.traffics.daily', compact('daily'));
    }

    public function monthly()
    {
        $monthly = $this->vnstat->monthly('eth1');
        return view('staff.traffics.monthly', compact('monthly'));
    }

    public function topten()
    {
        $topten = $this->vnstat->topten('eth1');
        return view('staff.traffics.topten', compact('topten'));
    }
}
