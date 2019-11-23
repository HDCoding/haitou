<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $achievements = $user->achievements;
        $unlocked = $user->unlockedAchievements()->count();

        return view('site.users.achievements', compact('achievements', 'unlocked'));
    }
}
