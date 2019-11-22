<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade300Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "300 Comentarios";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 300 Comentários";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 300;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
