<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade1000Topics extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "1000 Topicos";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 1000 Tópicos";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 1000;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
