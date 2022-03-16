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

class RegisteredUserController extends Controller
{
    use WithFileUploads;
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    public function create($plan)
    {
        $lands = Land::all_items();
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'profile_image' => ['nullable','image','mimes:jpeg,jpg,png,gif', 'max:500']
        ]);



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


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'trainer',
            'plan' => $plan,
            'school' => $request->school,
            'land_id' => $request->land_id,
            'image' => $filenameSmall
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/trainer/dashboard');
    }
}
