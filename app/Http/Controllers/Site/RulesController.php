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
        $user = $request->user();

        if ($user->readed_rules == false) {
            $user->unlock(new UserReadRules());
            $user->readed_rules = true;
            $user->update();
        }

        $rules = Rule::select('id', 'name', 'description')->get();

        return view('site.rules.index', compact('rules'));
    }
}
