<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //Logged user
        $user = $request->user();

        // For Cache
        $expire_at = Carbon::now()->addMinutes(20);

        // Unlocked
        $achievements = cache()->remember('achievements_'.$user->id, $expire_at, function () use ($user) {
            return $user->unlockedAchievements();
        });

        //Pending
        $pending = cache()->remember('pending_achievement_'.$user->id, $expire_at, function () use ($user) {
            return $user->inProgressAchievements();
        });

        //Count unlocked
        $unlocked = cache()->remember('unlocked_achievement_'.$user->id, $expire_at, function () use ($user) {
            return $user->unlockedAchievements()->count();
        });

        //Count locked
        $locked = cache()->remember('locked_achievement_'.$user->id, $expire_at, function () use ($user) {
            return $user->lockedAchievements()->count();
        });

        return view('site.users.achievements', compact('achievements', 'pending', 'unlocked', 'locked'));
    }
}
