<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMadeFirstUpload extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primeiro Upload";

    /*
     * A small description for the achievement
     */
    public $description = "Completou Primeiro Upload";

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
