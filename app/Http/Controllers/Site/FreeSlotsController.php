<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\FreeSlotRequest;
use App\Models\Freeslot;
use App\Models\FreeslotLog;
use Illuminate\Support\Facades\DB;

class FreeSlotsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $freeslot = Freeslot::where('is_active', '=', true)
            ->latest('id')
            ->exists();

        if (!empty($freeslot)) {
            $helpers = FreeslotLog::with('user:id')
                ->select('user_id', DB::raw('sum(donated) as total'))
                ->where('freeslot_id', '=', $freeslot->id)
                ->groupBy('user_id')
                ->orderBy('total', 'DESC')
                ->get();
        } else {
            $helpers = null;
        }

        return view('site.freeslots.index', compact('freeslot', 'helpers'));
    }

    public function store(FreeSlotRequest $request, $freeslot_id)
    {
        $user = $request->user();

        $freeslot = Freeslot::findOrFail($freeslot_id);

        $value = $request->input('point');

        if ($user->points >= $value) {

            if (($freeslot->actual + $value) >= $freeslot->required) {
                toastr()->info('Você não precisa doar mais que o necessário :D', 'Valeu');
                return redirect()->to('freeslots');
            }

            $user->points -= $value; //remove points from user
            $user->update();

            //insert the points to freeslots table
            $freeslot->actual += $value;
            $freeslot->save();

            //save the log
            $freeslot->freeslotlog()->create(['user_id' => $user->id, 'username' => $user->username, 'donated' => $value]);

        } else {
            toastr()->warning('Infelizmente você não possui pontos suficientes para doar!');
            return redirect()->to('freeslots');
        }

        toastr()->info('Doação realizada com sucesso! Agradecemos sua ajuda!');
        return redirect()->to('freeslots');
    }
}
