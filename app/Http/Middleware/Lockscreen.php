<?php

namespace App\Http\Middleware;

use Closure;

class Lockscreen
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
        $lock = $this->getLock();

        if ($lock['status'] == true) {
            //Erro ta aqui
        }

        return $next($request);
    }

    private function getLock()
    {
        return session()->get('locked');
    }
}
