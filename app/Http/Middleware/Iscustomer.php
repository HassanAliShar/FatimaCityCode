<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Iscustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->get('role_id') == 2){
            return $next($request);
        }
        return response('Unauthorized.', 401);
    }
}
