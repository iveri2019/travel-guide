<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use App\User;

class AdminMiddleware
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
        if (User::where('users.id',\Auth::user()->id)->where('admin',1)->count() > 0) {
             return $next($request);
        }else{
            return redirect('/home');
        }      
    }
}
