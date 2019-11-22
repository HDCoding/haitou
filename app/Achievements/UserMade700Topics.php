<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade700Topics extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "700 Topicos";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 700 Tópicos";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 700;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
