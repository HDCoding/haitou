<?php

namespace App\Listeners;

use App\Models\FailedLogin;
use App\Notifications\FailedLoginNotification;
use Illuminate\Auth\Events\Failed;
use Jenssegers\Agent\Agent;

class FailedLoginListener
{
    public function handle(Failed $event)
    {
        $user_id = $event->user ? $event->user->id : null;

        $agent = new Agent();

        if (isset($event->user) && is_a($event->user, 'Illuminate\Database\Eloquent\Model')) {
            $event->user->notify(new FailedLoginNotification());
        }

        return FailedLogin::create([
            'user_id' => $user_id,
            'email' => $event->credentials['email'],
            'ip' => request()->ip(),
            'user_agent' => $agent->browser() ? $agent->browser() : NULL,
            'system' => $agent->platform() ? $agent->platform() : NULL,
            'is_mobile' => $agent->isMobile(),
            'is_tablet' => $agent->isTablet(),
            'is_desktop' => $agent->isDesktop()
        ]);
    }
}
