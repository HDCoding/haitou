<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Cheater;
use App\Models\Historic;
use Illuminate\Support\Facades\DB;

class CheatersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:cheaters-mod');
    }

    /**
     * Possible Ghost Leech Cheaters.
     */
    public function index()
    {
        //cheaters
        $cheaters = Historic::with('user,id,username')
            ->select(['*'])
            ->join(
                DB::raw('(SELECT MAX(id) AS id FROM historics GROUP BY historics.user_id) AS unique_history'),
                function ($join) {
                    $join->on('historics.id', '=', 'unique_history.id');
                }
            )
            ->where('is_seeder', '=', 0)
            ->where('is_active', '=', 1)
            ->where('seed_time', '=', 0)
            ->where('real_downloaded', '=', 0)
            ->where('real_uploaded', '=', 0)
            ->whereNull('completed_at')
            ->latest()
            ->paginate(30);

        //programs from DB
        $programs = Cheater::paginate(30);

        return view('staff.cheaters.index', compact('cheaters', 'programs'));
    }
}
