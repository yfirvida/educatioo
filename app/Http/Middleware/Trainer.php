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
            if(Auth::user()->isTrainer() && Auth::user()->isActive()){
                return $next($request);
            }
            else{
                
                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();
                session()->flash('message', 'Your subscription has expired.');
                return redirect(route('home'));//for the others users
            }
        }
        else{
            return redirect(route('home'));
        }
    }
}
