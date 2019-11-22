<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserChangePrivacies extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Privacidades";

    /*
     * A small description for the achievement
     */
    public $description = "Alterou as Configurações de Privacidades";

    /**
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
