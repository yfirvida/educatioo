<?php

namespace App\Http\Livewire\Admin;
use App\Models\User;
use App\Models\Land;
use Livewire\WithPagination;

use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class Users extends Component
{
	use WithPagination;

	public $name, $role, $email, $password, $school, $plan_id, $land_id, $subscription_date;
    public $updateMode = false;
    public $lands, $current;

    public function render()
    {
        $t_quiz = 0;
        return view('livewire.admin.users', ['trainers' => User::where('role', 'trainer')->paginate(15), 'total_quiz' => $t_quiz]);
    }

    private function resetInputFields() {
        
        $this->name = '';
        $this->role = 'trainer';
        $this->email = '';
        $this->password = '';
        $this->school = '';
        $this->land_id = '';
        $this->subscription_date = '';
    }

    public function showForm() {
        self::resetInputFields();
        $this->resetErrorBag();
        $this->lands = Land::all_items();

        $this->dispatchBrowserEvent('openModal');

        
    }


    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => 'required',
            'school' => 'nullable',
            'land_id' => 'required',
            'subscription_date' => 'required',

        ]);



        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'trainer',
            'school' => $this->school,
            'land_id' => $this->land_id,
            'subscription_date' => $this->subscription_date
        ]);

        session()->flash('message', 'Trainer Created Successfully.');

        $this->resetInputFields();

        $this->dispatchBrowserEvent('closeModal'); // Close model to using to jquery

    }
    public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeUpdateModal');

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $user = User::where('id',$id)->first();
        $this->user_id = $id;
        $this->name = $user->name;
        $this->role = $user->role;
        $this->email = $user->email;
        $this->password = null;
        $this->school = $user->school;
        $this->land_id = $user->land_id;
        $this->subscription_date = $user->subscription_date;

        $this->lands = Land::all_items();

        $this->dispatchBrowserEvent('openUpdateModal');
        
    }

    public function cancelsubscription($id)
    {
        if($id){
        	$user = User::where('id',$id)->first();
        	$user->update([
            	'subscription_date' => NULL,
            ]);
            session()->flash('message', 'User Subscription was canceled Successfully.');
        }


    }  

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'school' => 'nullable',
            'land_id' => 'required',
            'subscription_date' => 'nullable',

        ]);

        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
            	'email' => $this->email,
            	'role' => $this->role,
            	'school' => $this->school,
            	'land_id' => $this->land_id,
            	'subscription_date' => $this->subscription_date,
            ]);
            if($this->password != null):
                $validatedData = $this->validate(['password' => 'required']);
                $user->update(['password' => Hash::make($this->password)]);
            endif;
            $this->updateMode = false;
            session()->flash('message', 'Trainer Updated Successfully.');
            $this->resetInputFields();

            $this->dispatchBrowserEvent('closeUpdateModal');

        }
    }

    public function confirm($user)
    {
        $this->current = $user; 
        $this->dispatchBrowserEvent('openconfirmModal');

    }

     public function closeconfirm()
    {

        $this->dispatchBrowserEvent('closeconfirmModal'); 

    }

    public function delete($id)
    {
        if($id){
        	User::find($id)->delete();
            session()->flash('message', 'User Deleted Successfully.');
        }
    }
}

