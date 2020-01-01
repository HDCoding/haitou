<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade800Invites extends Achievement
{
    private $userId;

    public function __construct($userId)
    {
        parent::__construct();
        $this->userId = $userId;
    }

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

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updateOfflinePoints($this->userId, $this->points);
    }

}
