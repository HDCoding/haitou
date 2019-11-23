<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\FreeSlotsRequest;
use App\Models\Freeslot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FreeSlotsController extends Controller
{
    public function index()
    {
        $freeslots = Freeslot::all();
        return view('staff.freeslots.index', compact('freeslots'));
    }

    public function update(FreeSlotsRequest $request, $request_id)
    {
        $sitepot = Freeslot::findOrFail($request_id);
        //pega os dados do form
        $freeleech = $request->input('is_freeleech') ? true : false;
        $silver = $request->input('is_silver') ? true : false;

        if ($silver && $freeleech) {
            toastr()->error('Silver e Freeleech dão conflito, escolha apenas 1.', 'Erro');
            return redirect()->back()->withInput();
        }

        $sitepot->required = $request->input('required');
        $sitepot->days = $request->input('days');
        $sitepot->is_doubleup = $request->input('is_doubleup') ? true : false;
        $sitepot->is_silver = $silver;
        $sitepot->is_freeleech = $freeleech;

        $sitepot->update();

        toastr()->info('Request atulizado.', 'Sucesso');
        return redirect()->to('staff/freeslots');
    }

    public function enableDisable()
    {
        $request = Freeslot::findOrFail(1);
        $request->is_enabled = !$request->is_enabled;
        $request->required = 0;
        $request->actual = 0;
        $request->days = 0;
        $request->is_freeleech = false;
        $request->is_silver = false;
        $request->is_doubleup = false;
        $request->update();

        DB::table('request_points')->truncate();

        toastr()->warning('Request Ativado/Desativado.', 'Aviso');
        return redirect()->to('staff/freeslots');
    }
}
