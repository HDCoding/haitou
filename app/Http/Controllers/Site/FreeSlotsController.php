<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\FreeSlotRequest;
use App\Models\Freeslot;
use Illuminate\Http\Request;

class FreeSlotsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $freeslot = Freeslot::with('freeslotlog')
            ->where('is_active', '=', true)
            ->latest('id')
            ->exists();

        return view('site.freeslots.index', compact('freeslot'));
    }

    public function store(FreeSlotRequest $request)
    {
        $freeslot_id = $request->input('freeslot_id');
        $freeslot = Freeslot::findOrFail($freeslot_id);
        $user = $request->user();
        $value = $request->input('point');

        if ($user->points >= $value) {
            //remove points from user
            $user->points -= $value;
            $user->save();
            //insert the points to request table
            $freeslot->actual += $value;
            $freeslot->save();

            $freeslot->freeslotlog()->create(['user_id' => $user->id, 'donated' => $value]);

        } else {
            toastr()->warning('Infelizmente você não possui pontos suficientes para doar!');
            return redirect()->to('freeslots');
        }

        toastr()->info('Doação realizada com sucesso! Agradecemos sua ajuda!');
        return redirect()->to('freeslots');
    }
}
