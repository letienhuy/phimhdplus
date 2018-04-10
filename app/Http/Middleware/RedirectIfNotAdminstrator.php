<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class RedirectIfNotAdminstrator
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
        if(Auth::check()){
            if(Auth::user()->right === 1){
                return $next($request);
            }
        }
        return abort(404);
    }
}
