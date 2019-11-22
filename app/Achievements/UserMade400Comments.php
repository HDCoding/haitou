<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade400Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "400 Comentarios";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 400 Comentários";

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
