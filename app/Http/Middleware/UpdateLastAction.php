<?php

namespace App\Http\Middleware;

use Closure;

class UpdateLastAction
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

        $user->last_action = now();
        $user->save();

        return $next($request);
    }
}
