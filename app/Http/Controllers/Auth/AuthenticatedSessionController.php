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
        $request->authenticate();
        $class_id = $request->class_id;
        \Session::put('class_id', $class_id);
         $exam_id = $request->course_id;
        \Session::put('course_id', $exam_id);
        $request->session()->regenerate();

        //return redirect()->intended(RouteServiceProvider::HOME);
        return redirect()->intended(self::home($request));

    }
    public static function home(LoginRequest $request) : string {

        if ( Auth::user()->isTrainer() ) {
               $user = Auth::user();
                $now = date('Y-m-d');
                $user->update(['last_session' => $now]);
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

        return '/';

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

        return redirect('/login');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyWeb(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
