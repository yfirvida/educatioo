<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminAuthenticated​
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
        if( Auth::check() )
        {
            // if user is trainer take him to his dashboard
            if ( Auth::user()->isTrainer() ) {
                 return redirect(route('trainer_dashboard'));
            }

            // if user is student take him to his dashboard
            if ( Auth::user()->isStudent() ) {
                 return redirect(route('student_dashboard'));
            }

            // allow admin to proceed with request
            else if ( Auth::user()->isAdmin() ) {
                 return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}
