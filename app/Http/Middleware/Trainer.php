<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Trainer
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
            if(Auth::user()->isTrainer()){
                return $next($request);
            }
            else{
                abort(404);//for the others users
            }
        }
        else{
            return redirect(route('home'));
        }
    }
}
