<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade4Birthdays extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Quarto Aniversario";

    /*
     * A small description for the achievement
     */
    public $description = "Membro há pelo menos 4 anos.";

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
