<?php

namespace App\Http\Middleware;

use Closure;

class IncrementTimeOnline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$user = $request->user()) {
            return $next($request);
        }

//        $last_login = $user->logins->last();
//
//        // Update Time Online
//        $old_update = $last_login->created_at ? $last_login->created_at->timestamp : now()->timestamp;
//
//        //Time Online
//        $new_time = now()->timestamp - $old_update;
//
//        $user->time_online += $new_time;
//        $user->save();

        return $next($request);
    }
}
