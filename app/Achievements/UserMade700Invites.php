<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade700Invites extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "700 Convites";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 700 Convites";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 700;

}
