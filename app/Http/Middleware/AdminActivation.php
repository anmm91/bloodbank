<?php

namespace App\Http\Middleware;

use Closure;

class AdminActivation
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
        if(auth('web')->user()->is_active==0){
            auth('web')->logout();
            return abort(401);
        }
        return $next($request);
    }
}
