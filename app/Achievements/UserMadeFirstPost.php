<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMadeFirstPost extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primeira Postagem";

    /*
     * A small description for the achievement
     */
    public $description = "Completou Primeira Postagem";

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
