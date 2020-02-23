<?php

namespace App\Http\Middleware;
use Closure;
use App\User;
use Auth;

class AdminCheck 
{

    public function handle($request, Closure $next)
    {
    	// if (Auth::user()->role_id == 1) {
    		 return $next($request);
    	// }
        
    }
}
