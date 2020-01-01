<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade800Invites extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "800 Convites";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 800 Convites";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 800;

}
