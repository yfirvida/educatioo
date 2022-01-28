<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Admin
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
        
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                return $next($request);
            }
            else{
                abort(404);//for the others users
            }
        }
        else{
            return redirect(route('login'));
        }
    }
}
