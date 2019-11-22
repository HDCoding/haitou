<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade50Topics extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "50 Topicos";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 50 Tópicos";

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
