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

        // Update Time Online
        $old_update = $user->updated_at ? $user->updated_at->timestamp : now()->timestamp;

        //Time Online
        $new_time = now()->timestamp - $old_update;

        if ($new_time < 200) {
            $user->time_online += $new_time;
            $user->save();
        }

        return $next($request);
    }
}
