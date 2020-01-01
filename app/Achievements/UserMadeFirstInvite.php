<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMadeFirstInvite extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primeiro Convite";

    /*
     * A small description for the achievement
     */
    public $description = "Completou Primeiro Convite";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 100;

}
