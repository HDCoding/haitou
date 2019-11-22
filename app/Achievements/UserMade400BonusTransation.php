<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade400BonusTransation extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "400 Transacoes de Bonus";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 400 Transações de Bônus";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 400;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
