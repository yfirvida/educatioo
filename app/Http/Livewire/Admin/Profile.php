<?php

namespace App\Http\Livewire\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Land;

use Livewire\Component;

class Profile extends Component
{
	public $name, $email, $password, $land_id;
    public $updateMode = false;
    public $lands;

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

        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closePassModal');

    }
}
