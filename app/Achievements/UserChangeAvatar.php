<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserChangeAvatar extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Avatar";

    /*
     * A small description for the achievement
     */
    public $description = "Alterou a Imagem de Avatar";

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
