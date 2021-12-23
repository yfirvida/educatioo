<?php

namespace App\Http\Livewire\Admin;
use App\Models\User;
use App\Models\Land;
use App\Models\Plan;
use Livewire\WithPagination;

use Livewire\Component;

class Users extends Component
{
	use WithPagination;

	public $name, $role, $email, $password, $school, $plan_id, $land_id, $subscription_date;
    public $updateMode = false;
    public $lands, $plans;

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
        $this->lands = Land::all_items();
        $this->plans = Plan::all_items();

        $this->dispatchBrowserEvent('openModal');

        
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
            'plan_id' => 'required',
            'subscription_date' => 'required',

        ]);

        User::create($validatedData);

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
        $this->password = $user->password;
        $this->school = $user->school;
        $this->land_id = $user->land_id;
        $this->plan_id = $user->plan_id;
        $this->subscription_date = $user->subscription_date;

        $this->lands = Land::all_items();
        $this->plans = Plan::all_items();

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
            session()->flash('message', 'Trainer Updated Successfully.');
            $this->resetInputFields();

            $this->dispatchBrowserEvent('closeUpdateModal');

        }
    }

    public function delete($id)
    {
        if($id){
        	User::find($id)->delete();
            session()->flash('message', 'User Deleted Successfully.');
        }
    }
}

