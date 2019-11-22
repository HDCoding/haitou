<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserReadRules extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "As Regras";

    /*
     * A small description for the achievement
     */
    public $description = "Completo Leu as Regras";

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
