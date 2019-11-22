<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade600Posts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "600 Postagens";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 600 Postagens";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 600;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
