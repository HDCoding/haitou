<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMadeFirstComment extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primeiro Comentario";

    /*
     * A small description for the achievement
     */
    public $description = "Completou Primeiro Comentário";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 100;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
