<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoodsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $moods = Mood::select('id', 'name', 'image', 'points')->get();
        return view('staff.moods.index', compact('moods'));
    }

//    public function create()
//    {
//        //
//    }
//
//    public function store(Request $request)
//    {
//        //
//    }

    public function update(Request $request, $mood_id)
    {
        if ($request->ajax()) {
            DB::table('moods')
                ->where('id', '=', $request->get('pk'))
                ->update([$request->get('name') => $request->get('value')]);

            return response()->json(['success' => 'Mood atulizado.'], 200);
        }
        return response()->json(['error' => 400, 'message' => 'Parametros insuficientes.'], 400);
    }

//    public function destroy($mood_id)
//    {
//        //
//    }
}
