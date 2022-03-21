<?php

namespace App\Http\Livewire\Admin;
use App\Models\Land;
use Livewire\WithPagination;

use Livewire\Component;

class Lands extends Component
{
    use WithPagination;
    
	public $name, $iso, $phonecode, $current;
    public $updateMode = false;

    public function render()
    {
        return view('livewire.admin.lands', ['lands' => Land::paginate(15)]);
    }

    private function resetLandsInputFields() {
        
        $this->name     	= '';
        $this->iso      	= '';
        $this->phonecode	= '';
    }

    public function showForm() {
        self::resetLandsInputFields();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openModal');
    }


    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'iso' => 'required',
            'phonecode' => 'required',
        ]);

        Land::create($validatedData);

        session()->flash('message', 'Land Created Successfully.');

        $this->resetLandsInputFields();

        $this->dispatchBrowserEvent('closeModal'); // Close model to using to jquery

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $land = Land::where('id',$id)->first();
        $this->land_id = $id;
        $this->name = $land->name;
        $this->iso = $land->iso;
        $this->phonecode = $land->phonecode;

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
            'iso' => 'required',
            'phonecode' => 'required',
        ]);

        if ($this->land_id) {
            $land = Land::find($this->land_id);
            $land->update([
                'name' => $this->name,
                'iso' => $this->iso,
                'phonecode' => $this->phonecode,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Land Updated Successfully.');
            $this->resetLandsInputFields();
            $this->dispatchBrowserEvent('closeUpdateModal');

        }
    }
    public function confirm($land)
    {
        $this->current = $land; 
        $this->dispatchBrowserEvent('openconfirmModal');

    }

     public function closeconfirm()
    {

        $this->dispatchBrowserEvent('closeconfirmModal'); 

    }
    public function delete($id)
    {
        if($id){
            Land::where('id',$id)->delete();
            session()->flash('message', 'Land Deleted Successfully.');
        }
    }

    
}




