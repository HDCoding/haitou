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

        if (isset($event->user) && is_a($event->user, 'Illuminate\Database\Eloquent\Model')) {
            $event->user->notify(new FailedLoginNotification());
        }

        $agent = new Agent();
        //User Agent
        $browser = $agent->browser() ? $agent->browser() : NULL;
        //Operational System
        $system = $agent->platform() ? $agent->platform() : NULL;

        return FailedLogin::create([
            'user_id' => $user_id,
            'email' => $event->credentials['email'],
            'ip' => request()->ip(),
            'user_agent' => $browser,
            'bot' => $agent->robot() == false ? null : $agent->robot(),
            'os_family' => strtolower($system),
            'os' => $system,
            'browser_family' => strtolower($browser),
            'browser' => $browser . ' ' . $agent->version($browser),
            'is_desktop' => $agent->isDesktop(), //Is Desktop
            'is_mobile' => $agent->isMobile(), //Is Mobile
            'is_tablet' => $agent->isTablet(), //Is Tablet
            'is_bot' => $agent->isRobot(), //Is Bot
        ]);
    }
}
