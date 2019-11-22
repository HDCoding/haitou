<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade50Posts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "50 Postagens";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 50 Postagens";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 50;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
