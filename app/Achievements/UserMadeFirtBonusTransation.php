<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMadeFirtBonusTransation extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Transacao de Bonus";

    /*
     * A small description for the achievement
     */
    public $description = "Completou Primeira Transação de Bonus";

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
