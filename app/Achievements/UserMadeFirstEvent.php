<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMadeFirstEvent extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primeiro Evento";

    /*
     * A small description for the achievement
     */
    public $description = "Completou Primeiro Evento";

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
