<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\SystemInformation;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\SslCertificate\SslCertificate;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pendent = User::where('status', '=', 0)->count();
        $activated = User::where('status', '=', 1)->count();
        $suspended = User::where('status', '=', 2)->count();
        $banned = User::where('status', '=', 3)->count();

        $system = new SystemInformation();

        $certificate = SslCertificate::createForHostName('spatie.be');//config('app.url')

        return view('staff.staff.index', compact('pendent', 'activated', 'suspended', 'banned', 'system', 'certificate'));
    }
}
