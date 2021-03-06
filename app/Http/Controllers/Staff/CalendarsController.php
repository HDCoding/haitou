<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Calendar;

class CalendarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:calendarios-mod');
    }

    public function index()
    {
        $calendars = Calendar::select('id', 'user_id', 'username', 'name', 'start_date', 'end_date', 'color', 'is_enabled', 'views', 'created_at')
            ->orderBy('id', 'DESC')->get();

        return view('staff.calendars.index', compact('calendars'));
    }

    public function update($calendar_id)
    {
        $calendar = Calendar::findOrFail($calendar_id);
        $calendar->is_enabled = !$calendar->is_enabled;
        $calendar->update();
        toastr()->success('Calendario ativado/desativado', 'Sucesso');
        return redirect()->to('staff/calendars');
    }

    public function destroy($calendar_id)
    {
        Calendar::findOrFail($calendar_id)->delete();
        toastr()->warning('Calendario deletado.', 'Aviso');
        return redirect()->to('staff/calendars');
    }
}
