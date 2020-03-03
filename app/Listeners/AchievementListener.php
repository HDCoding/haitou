<?php

namespace App\Listeners;

use Gstt\Achievements\Event\Unlocked;

class AchievementListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Unlocked $event
     * @return void
     */
    public function handle(Unlocked $event)
    {
        $value = $event->progress->details->name;
        toastr()->success($value, 'Conquista desbloqueada:');
    }
}
