<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade50Invites extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "50 Convites";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 50 Convites";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 50;

}
