<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Lockscreen
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
        //make this really works

//        $lock = $this->getLock();
//
//        if ($lock['status'] == true) {
//            //Erro ta aqui
//        }
//
//        return $next($request);
    }

    private function getLock()
    {
        return session()->get('locked');
    }
}
