<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade300Invites extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "300 Convites";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 300 Convites";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 300;

}
