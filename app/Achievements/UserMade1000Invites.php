<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade1000Invites extends Achievement
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
    public $name = "1000 Convites";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 1000 Convites";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 1000;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updateOfflinePoints($this->userId, $this->points);
    }

}
