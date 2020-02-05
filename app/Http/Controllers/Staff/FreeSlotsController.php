<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\FreeSlotsRequest;
use App\Models\Freeslot;

class FreeSlotsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:freeslots-mod');
    }

    public function index()
    {
        $freeslots = Freeslot::all();
        return view('staff.freeslots.index', compact('freeslots'));
    }

    public function create()
    {
        return view('staff.freeslots.create');
    }

    public function store(FreeSlotsRequest $request)
    {
        $sitepot = new Freeslot();
        //pega os dados do form
        $freeleech = $request->input('is_freeleech') ? true : false;
        $silver = $request->input('is_silver') ? true : false;

        if ($silver && $freeleech) {
            toastr()->error('Silver e Freeleech dão conflito, escolha apenas 1.', 'Erro');
            return redirect()->back()->withInput();
        }

        $sitepot->name = $request->input('name');
        $sitepot->required = $request->input('required');
        $sitepot->days = $request->input('days');
        $sitepot->is_doubleup = $request->input('is_doubleup') ? true : false;
        $sitepot->is_silver = $silver;
        $sitepot->is_freeleech = $freeleech;
        $sitepot->is_active = true;
        $sitepot->save();

        toastr()->info('Request criado.', 'Sucesso');
        return redirect()->to('staff/freeslots');
    }

    public function edit($freeslot_id)
    {
        $sitepot = Freeslot::findOrFail($freeslot_id);
        return view('staff.freeslots.edit', compact('sitepot'));
    }

    public function update(FreeSlotsRequest $request, $freeslot_id)
    {
        $sitepot = Freeslot::findOrFail($freeslot_id);
        //pega os dados do form
        $freeleech = $request->input('is_freeleech') ? true : false;
        $silver = $request->input('is_silver') ? true : false;

        if ($silver && $freeleech) {
            toastr()->error('Silver e Freeleech dão conflito, escolha apenas 1.', 'Erro');
            return redirect()->back()->withInput();
        }

        $sitepot->name = $request->input('name');
        $sitepot->required = $request->input('required');
        $sitepot->days = $request->input('days');
        $sitepot->is_doubleup = $request->input('is_doubleup') ? true : false;
        $sitepot->is_silver = $silver;
        $sitepot->is_freeleech = $freeleech;
        $sitepot->update();

        toastr()->info('Request atulizado.', 'Sucesso');
        return redirect()->to('staff/freeslots');
    }

    public function destroy($freeslot_id)
    {
        $sitepot = Freeslot::findOrFail($freeslot_id);
        $sitepot->is_active = false;
        $sitepot->save();
        $sitepot->delete();
        toastr()->warning('Free Slot deletado.', 'Aviso');
        return redirect()->to('staff/freeslots');
    }
}
