<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Allow
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        if ($permission !== null && !$request->user()->can($permission)) {
            abort(403);
        }

        return $next($request);
    }
}
