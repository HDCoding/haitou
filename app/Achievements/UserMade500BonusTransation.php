<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade500BonusTransation extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "500 Transacoes de Bonus";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 500 Transacoes de Bonus";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 500;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
