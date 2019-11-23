<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserReadRules;
use App\Http\Controllers\Controller;
use App\Models\Rule;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $rules = Rule::select('id', 'name', 'description')->get();

        $user = $request->user();

        if ($user->read_rules == false) {
            $user->unlock(new UserReadRules());
            $user->read_rules = true;
            $user->save();
        }
        return view('site.rules.index', compact('rules'));
    }
}
