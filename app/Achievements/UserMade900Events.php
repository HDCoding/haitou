<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade900Events extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "900 Eventos";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 900 Eventos";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 900;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
