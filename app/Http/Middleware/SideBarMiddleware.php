<?php

namespace App\Http\Middleware;
use App\TinBDS;
use DB;

use Closure;

class SideBarMiddleware
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
        
        return $request;
    }
}
