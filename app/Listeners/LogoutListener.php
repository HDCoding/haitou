<?php

namespace App\Listeners;

class LogoutListener
{
    public function handle($event)
    {
        if ($event->user !== null) {
            $event->user->pullCache();
        }
    }
}
