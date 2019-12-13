<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\SettingsRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = setting()->all();
        return View::make('staff.settings.index', compact('settings'));
//        return view('staff.settings.index', compact('settings'));
    }

    public function edit($setting_id)
    {
        $setting = Setting::find($setting_id);
        return view('staff.settings.edit', compact('setting'));
    }

    public function update(SettingsRequest $request)
    {

        setting($request->except('_token', '_method'));

        toastr()->info('Configuração atualizada.', 'Sucesso');
        return redirect()->to('staff/settings');
    }
}
