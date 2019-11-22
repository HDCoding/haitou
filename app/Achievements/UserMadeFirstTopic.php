<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMadeFirstTopic extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primeiro Topico";

    /*
     * A small description for the achievement
     */
    public $description = "Completou Primeiro Tópico";

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
