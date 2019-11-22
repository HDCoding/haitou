<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade5Birthdays extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Quinto Aniversario";

    /*
     * A small description for the achievement
     */
    public $description = "Membro há pelo menos 5 anos.";

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
