<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade200Invites extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "200 Convites";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 200 Convites";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 200;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
