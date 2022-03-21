<?php

namespace App\Http\Livewire\Admin;
use App\Models\Plan;
use Livewire\WithPagination;

use Livewire\Component;

class Plans extends Component
{
	use WithPagination;
    
    public $name, $intro, $link, $current;
    public $updateMode = false;

    public function render()
    {
        return view('livewire.admin.plans', ['plans' => Plan::paginate(15)]);
    }
    private function resetInputFields() {
        
        $this->name = '';
        $this->intro = '';
        $this->link = '';
    }

    public function showForm() {
        self::resetInputFields();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openModal');
    }


    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'intro' => 'required',
            'link' => 'nullable|url',
        ]);

        Plan::create($validatedData);

        session()->flash('message', 'Plan Created Successfully.');

        $this->resetInputFields();

        $this->dispatchBrowserEvent('closeModal'); // Close model to using to jquery

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $plan = Plan::where('id',$id)->first();
        $this->plan_id = $id;
        $this->name = $plan->name;
        $this->intro = $plan->intro;
        $this->link = $plan->link;

        $this->dispatchBrowserEvent('openUpdateModal');
        
    }

    public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeUpdateModal');
    }


    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'intro' => 'required',
            'link' => 'nullable|url',
        ]);

        if ($this->plan_id) {
            $plan = Plan::find($this->plan_id);
            $plan->update([
                'name' => $this->name,
                'intro' => $this->intro,
                'link' => $this->link
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Plan Updated Successfully.');
            $this->resetInputFields();
            $this->dispatchBrowserEvent('closeUpdateModal');


        }
    }

    public function confirm($plan)
    {
        $this->current = $plan; 
        $this->dispatchBrowserEvent('openconfirmModal');

    }

     public function closeconfirm()
    {

        $this->dispatchBrowserEvent('closeconfirmModal'); 

    }

    public function delete($id)
    {
        if($id){
            Plan::where('id',$id)->delete();
            session()->flash('message', 'Plan Deleted Successfully.');
        }
    }
}

