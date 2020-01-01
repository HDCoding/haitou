<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMadeFirstInvite extends Achievement
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
    public $name = "Primeiro Convite";

    /*
     * A small description for the achievement
     */
    public $description = "Completou Primeiro Convite";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 100;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updateOfflinePoints($this->userId, $this->points);
    }

}
