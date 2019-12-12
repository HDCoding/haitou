<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Gstt\Achievements\Model\AchievementDetails;

class AchievementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $achievements = AchievementDetails::all();
        return view('staff.achievements.index', compact('achievements'));
    }
}
