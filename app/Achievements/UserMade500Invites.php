<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade500Invites extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "500 Convites";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 500 Convites";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 500;

}
