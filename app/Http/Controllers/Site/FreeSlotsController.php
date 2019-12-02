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
        $freeslot = Freeslot::all()->where('is_active', '=', true)->last();
        $percent = $freeslot->percent();
        return view('site.freeslots.index', compact('freeslot', 'percent'));
    }

    public function store(FreeSlotRequest $request)
    {
        $site_point = Freeslot::findOrFail(1);
        $user = $request->user();
        $value = $request->input('point');

        if ($user->points >= $value) {
            //remove points from user
            $user->points -= $value;
            $user->save();
            //insert the points to request table
            $site_point->actual += $value;
            $site_point->save();

            $site_point->request_points()->create(['user_id' => $user->id, 'donated' => $value]);

        } else {
            toastr()->warning('Infelizmente você não possui pontos suficientes para doar!');
            return redirect()->to('freeslots');
        }

        toastr()->info('Doação realizada com sucesso! Agradecemos sua ajuda!');
        return redirect()->to('freeslots');
    }
}
