<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade400Events extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "400 Eventos";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 400 Eventos";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 400;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
