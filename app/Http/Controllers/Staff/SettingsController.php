<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\SettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $setting = Setting::all();
        return view('staff.settings.index', compact('setting'));
    }

    public function update(SettingsRequest $request, $setting_id)
    {
        Setting::findOrFail($setting_id)->update($request->except('_token'));
        toastr()->info('Configurações atualizada.', 'Sucesso');
        return redirect()->to('staff/settings');
    }
}
