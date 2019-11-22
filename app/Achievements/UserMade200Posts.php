<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade200Posts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "200 Postagens";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 200 Postagens";

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
