<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\SystemInformation;
use App\Http\Controllers\Controller;
use Spatie\SslCertificate\SslCertificate;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $system = new SystemInformation();

        $certificate = SslCertificate::createForHostName('spatie.be');//config('app.url')

        return view('staff.staff.index', compact('system', 'certificate'));
    }
}
