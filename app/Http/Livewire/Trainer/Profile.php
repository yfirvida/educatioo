<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Land;
use App\Models\Plan;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic;
use Livewire\WithFileUploads;

class Profile extends Component
{
    
    use WithFileUploads;

    public $lands, $plan;
    public $user, $name, $password, $school, $land_id, $email, $image, $profile_image;
    public $uploaded = false;
    protected $listeners = ['fileUpload'];
    

    public function mount()
    {
        
        $this->user =  Auth::user();
        $this->lands = Land::all_items();
        $this->image = $this->user->image;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->school = $this->user->school;
        $this->land_id = $this->user->land_id;
        $this->password = '******';

        $plan_id = 1;
        if($this->user->plan == "Premium"){ $plan_id = 2;}
        $this->plan = Plan::find($plan_id);
    }
    public function render()
    {
        $this->image = $this->user->image;
        return view('livewire.trainer.profile')->layout('layouts.main');
    }

    public function fileUpload($imageData){
        $this->profile_image = $imageData;
        $this->uploaded = false;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'land_id' => 'required',
            'school' => 'nullable',
            'profile_image' => 'image|mimes:jpeg,jpg,png,gif|max:500|nullable'

        ]);

            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'land_id' => $this->land_id,
                'school' => $this->school,
            ]);

            //update password if change
            if($this->password != '******'){
                $this->user->update([
                'password' => Hash::make($this->password),
            ]);
            }

            //update profile image id change
            if($this->profile_image != null){
                $images = [
                    'name' => $this->profile_image->getClientOriginalName(),
                    'path' => $this->profile_image->getRealPath(),
                    'extension' => $this->profile_image->getClientOriginalExtension(),
                ];
                $filenameSmall = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' .  $images['extension'];
                $path = public_path('uploads/' . $filenameSmall);
                ImageManagerStatic::make( $images['path'])->orientate()->fit(300, 300, function ($constraint) {
                    $constraint->upsize();

                },'top')->save($path);

                if (!empty($this->user->image)){
                    @unlink(public_path("uploads/".$user->image.""));
                }

                $this->user->image =  $filenameSmall;
                $this->user->save();
                $this->uploaded = true;

            }



            session()->flash('message', 'Profile Updated Successfully.');

            $this->dispatchBrowserEvent('closeUpdateModal');
    }

}
