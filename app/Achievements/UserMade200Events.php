<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade200Events extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "200 Eventos";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 200 Eventos";

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
