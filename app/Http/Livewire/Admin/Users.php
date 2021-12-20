<?php

namespace App\Http\Livewire\Admin;
use App\Models\User;
use Livewire\WithPagination;

use Livewire\Component;

class Users extends Component
{
	use WithPagination;

	public $level;
    public $updateMode = false;

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
        $this->plan_id = '';
        $this->subscription_date = '';
    }

    public function showForm() {
        self::resetInputFields();
        $this->resetErrorBag();
    }


    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'school' => 'nullable',
            'land_id' => 'required',
            'plan_id' => 'nullable',
            'subscription_date' => 'nullable',

        ]);

        User::create($validatedData);

        session()->flash('message', 'Trainer Created Successfully.');

        $this->resetInputFields();

        $this->emit('trainerStore'); // Close model to using to jquery

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $user = User::where('id',$id)->first();
        $this->user_id = $id;
        $this->name = $user->name;
        $this->role = $user->role;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->school = $user->school;
        $this->land_id = $user->land_id;
        $this->plan_id = $user->plan_id;
        $this->subscription_date = $user->subscription_date;
        
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();


    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'school' => 'nullable',
            'land_id' => 'required',
            'plan_id' => 'nullable',
            'subscription_date' => 'nullable',

        ]);

        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
            	'email' => $this->email,
            	'password' => $this->password,
            	'role' => $this->role,
            	'school' => $this->school,
            	'land_id' => $this->land_id,
            	'plan_id' => $this->plan_id,
            	'subscription_date' => $this->subscription_date,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'User Updated Successfully.');
            $this->resetInputFields();

        }
    }

    public function delete($id)
    {
        if($id){
            User::where('id',$id)->delete();
            session()->flash('message', 'User Deleted Successfully.');
        }
    }
}

