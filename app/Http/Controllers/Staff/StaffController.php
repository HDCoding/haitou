<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\SystemInformation;
use App\Http\Controllers\Controller;
use Exception;
use Spatie\SslCertificate\SslCertificate;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:painel-staff');
    }

    public function index()
    {
        // System Information
        $system = new SystemInformation();

        // SSL Info
        try {
            $certificate = SslCertificate::createForHostName(config('app.url'));
        } catch (Exception $exception) {
            $certificate = '';
        }

        // Directory Permissions
        $file_permissions = $system->directoryPermissions();

        return view('staff.staff.index', compact('system', 'certificate', 'file_permissions'));
    }
}
