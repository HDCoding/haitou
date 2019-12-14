<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('staff.settings.index');
    }

    public function edit($setting_id)
    {
        $setting = Setting::find($setting_id);
        return view('staff.settings.edit', compact('setting'));
    }

    public function store(Request $request)
    {

        $rules = Setting::getValidationRules();
        $data = $this->validate($request, $rules);
        $validSettings = array_keys($rules);
        foreach ($data as $key => $val) {
            if( in_array($key, $validSettings) ) {
                Setting::add($key, $val, Setting::getDataType($key));
            }
        }

        toastr()->info('Configuração atualizada.', 'Sucesso');
        return redirect()->to('staff/settings');
    }
}
