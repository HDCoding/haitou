<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\FreeSlotRequest;
use App\Models\Freeslot;
use Illuminate\Http\Request;

class FreeSlotsController extends Controller
{
    public function index()
    {
        $points = Freeslot::find(1);
        $percent = $points->getPercent();
        return view('site.requests.index', compact('points', 'percent'));
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
            return redirect()->to('requests');
        }

        toastr()->info('Doação realizada com sucesso! Agradecemos sua ajuda!');
        return redirect()->to('requests');
    }
}
