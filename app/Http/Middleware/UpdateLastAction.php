<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UpdateLastAction
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //TODO
        //lock to a better way to update this
        //THE RETURN = select `slug`, `users`.`id` from `users` where (`slug` = 'monil' or `slug` LIKE 'monil-%')
        if (!$user = $request->user()) {
            return $next($request);
        }

        $user->last_action = now();
        $user->save();

        return $next($request);
    }
}
