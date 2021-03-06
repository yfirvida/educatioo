<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Land;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic;
use Livewire\WithFileUploads;
use Mail;
use App\Mail\Register;

class RegisteredUserController extends Controller
{
    use WithFileUploads;
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    public function create($p)
    {
        $lands = Land::all_items();
        $plan = '';
        if($p == 'Hke9dkeM-*$Jdajdskfj$CLNEN$T'){ $plan = 'Premium';}
        if($p == 'Gtfr56-Lkbg*$ogtRwl90*$$k8965h'){ $plan = 'Basic';}
        
        return view('auth.register', compact('lands', 'plan'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $plan)
    {
       
       $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', Rules\Password::defaults()],
            'profile_image' => ['nullable','image','mimes:jpeg,jpg,png,gif', 'max:500']
        ]);
       //, 'unique:users'


        $filenameSmall = null;

        if($request->file('profile_image') != null){
            $images = [
            'name' => $request->file('profile_image')->getClientOriginalName(),
            'path' => $request->file('profile_image')->getRealPath(),
            'extension' => $request->file('profile_image')->getClientOriginalExtension(),
            ];
            $filenameSmall = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' .  $images['extension'];
            $path = public_path('uploads/' . $filenameSmall);
            ImageManagerStatic::make( $images['path'])->orientate()->fit(300, 300, function ($constraint) {
                $constraint->upsize();

            },'top')->save($path);

        }

        $now = date('Y-m-d');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'trainer',
            'plan' => $plan,
            'school' => $request->school,
            'land_id' => $request->land_id,
            'subscription_date' => $now,
            'image' => $filenameSmall
        ]);


        //send mail

        Mail::to($user)->send(new Register($user));



        event(new Registered($user));

        Auth::login($user);

        return redirect('/trainer/dashboard');
    }
}
