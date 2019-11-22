<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade50BonusTransaction extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "50 Transacoes de Bonus";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 50 Transações de Bônus";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 50;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
