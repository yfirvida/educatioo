<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
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
                    return redirect('/admin/dashboard');
                }
               // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
