<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandsController extends Controller
{
    /**
     * Display All Commands.
     */
    public function index()
    {
        return view('staff.commands.index');
    }

    /**
     * Bring Site Into Maintenance Mode.
     */
    public function maintanceEnable(Request $request)
    {
        Artisan::call('down --allow=' . $request->ip());
        toastr()->info(trim(Artisan::output()), 'Aviso');
        return redirect()->route('staff.commands');
    }

    /**
     * Bring Site Out Of Maintenance Mode.
     */
    public function maintanceDisable()
    {
        Artisan::call('up');
        toastr()->info(trim(Artisan::output()), 'Aviso');
        return redirect()->route('staff.commands');
    }

    /**
     * Clear Site Cache.
     */
    public function clearCache()
    {
        Artisan::call('cache:clear');
        toastr()->info(trim(Artisan::output()), 'Aviso');
        return redirect()->route('staff.commands');
    }

    /**
     * Clear Site View Cache.
     */
    public function clearView()
    {
        Artisan::call('view:clear');
        toastr()->info(trim(Artisan::output()), 'Aviso');
        return redirect()->route('staff.commands');
    }

    /**
     * Clear Site Routes Cache.
     */
    public function clearRoute()
    {
        Artisan::call('route:clear');
        toastr()->info(trim(Artisan::output()), 'Aviso');
        return redirect()->route('staff.commands');
    }

    /**
     * Clear Site Config Cache.
     */
    public function clearConfig()
    {
        Artisan::call('config:clear');
        toastr()->info(trim(Artisan::output()), 'Aviso');
        return redirect()->route('staff.commands');
    }

    /**
     * Clear All Site Cache At Once.
     */
    public function clearAllCache()
    {
        Artisan::call('clear:all_cache');
        toastr()->info(trim(Artisan::output()), 'Aviso');
        return redirect()->route('staff.commands');
    }

    /**
     * Set All Site Cache At Once.
     */
    public function setAllCache()
    {
        Artisan::call('set:all_cache');
        toastr()->info(trim(Artisan::output()), 'Aviso');
        return redirect()->route('staff.commands');
    }

    /**
     * Send Test Email To Test Email Configuration.
     */
    public function testEmail()
    {
        Artisan::call('test:email');
        toastr()->info(trim(Artisan::output()), 'Aviso');
        return redirect()->route('staff.commands');
    }
}
