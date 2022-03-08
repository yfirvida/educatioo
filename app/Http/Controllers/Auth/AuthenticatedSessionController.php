<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $course_id = $request->course_id;
        $group_id = $request->group_id;

        $request->authenticate();

        $request->session()->regenerate();

        //return redirect()->intended(RouteServiceProvider::HOME);
        return redirect()->intended(self::home($request))->with(['course_id'=> $course_id, 'group_id' => $group_id]);

    }
    public static function home(LoginRequest $request) : string {

        if ( Auth::user()->isTrainer() ) {
            return '/trainer/dashboard';
        }

        // if user is student take him to his dashboard
        if ( Auth::user()->isStudent() ) {
            return '/student/dashboard';
        }

        // allow admin to proceed with request
        else if ( Auth::user()->isAdmin() ) {
            return '/admin/dashboard';
        }

        return '/dashboard';

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
