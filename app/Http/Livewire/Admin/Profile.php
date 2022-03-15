<?php

namespace App\Http\Livewire\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Land;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

use Livewire\Component;

class Profile extends Component
{
    use WithFileUploads;

	public $name, $email, $password, $land_id;
    public $updateMode = false;
    public $lands;
    public $image;
    public $profile_image;
    public $uploaded = false;
    protected $listeners = ['fileUpload'];

    public function mount()
    {
        
        $user =  Auth::user();
        $this->profile_image = $user->image;
    }

    public function render()
    {
        
        $user =  Auth::user();
        return view('livewire.admin.profile', ['user' => $user]);
    }

    private function resetInputFields() {
        
        $this->name = '';
        $this->email = '';
        $this->land_id = '';
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $user = Auth::user();
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->land_id = $user->land_id;

        $this->lands = Land::all_items();

        $this->dispatchBrowserEvent('openUpdateModal');
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'land_id' => 'required',

        ]);

        if ($this->user_id) {
            $user = Auth::user();
            $user->update([
                'name' => $this->name,
            	'email' => $this->email,
            	'land_id' => $this->land_id,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'Profile Updated Successfully.');
            $this->resetInputFields();

            $this->dispatchBrowserEvent('closeUpdateModal');

        }
    }
    public function editpass($id)
    {
        $this->updateMode = true;
        $user = Auth::user();
        $this->password = "";

        $this->dispatchBrowserEvent('openPassModal');
        
    }

    public function updatepass()
    {
        $validatedData = $this->validate([
            'password' => 'required',

        ]);

        if ($this->user_id) {
            $user = Auth::user();
            $user->update([
                'password' => $this->password,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'Password Updated Successfully.');

            $this->dispatchBrowserEvent('closePassModal');

        }
    }
    public function close()
    {

        $this->dispatchBrowserEvent('closeUpdateModal'); 
        $this->dispatchBrowserEvent('closePassModal');

    }


    public function fileUpload($imageData){
        $this->image = $imageData;
        $this->uploaded = false;
    }

    public function uploadImage(Request $request){

        $this->validate([
            'profile_image' => 'image|mimes:jpeg,jpg,png,gif|max:500|required'
        ]);
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

        $user = User::find(Auth::user()->id);

        if (!empty($user->image)){
            @unlink(public_path("uploads/".$user->image.""));
        }

        $user->image =  $filenameSmall;
        $user->save();
        $this->uploaded = true;

        $this->profile_image  = $user->image;
        $this->emit('uploadedImage');
        session()->flash('successImage', __('Your profile image has been uploaded succesfully.'));
    }
}
