<?php

namespace App\Listeners;

use App\Models\Login;
use Jenssegers\Agent\Agent;

class LoginListener
{
    public function handle($event)
    {
        $user_id = $event->user ? $event->user->id : null;

        if ($event->user !== null) {
            $event->user->setCache(config('session.lifetime') * 60);
        }

        $agent = new Agent();

        return Login::create([
            'user_id' => $user_id,
            'ip' => request()->ip(),
            'user_agent' => $agent->browser() ? $agent->browser() : NULL,
            'system' => $agent->platform() ? $agent->platform() : NULL,
            'is_mobile' => $agent->isMobile(),
            'is_tablet' => $agent->isTablet(),
            'is_desktop' => $agent->isDesktop()
        ]);
    }
}
