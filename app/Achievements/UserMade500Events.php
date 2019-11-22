<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade500Events extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "500 Eventos";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 500 Eventos";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 500;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
