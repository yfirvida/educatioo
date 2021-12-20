<?php

namespace App\Http\Livewire\Admin;
use App\Models\Land;

use Livewire\Component;

class Lands extends Component
{
	public $name, $iso, $phonecode;
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

        $this->emit('landStore'); // Close model to using to jquery

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $land = Land::where('id',$id)->first();
        $this->land_id = $id;
        $this->name = $land->name;
        $this->iso = $land->iso;
        $this->phonecode = $land->phonecode;
        
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetLandsInputFields();


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

        }
    }

    public function delete($id)
    {
        if($id){
            Land::where('id',$id)->delete();
            session()->flash('message', 'Land Deleted Successfully.');
        }
    }
}




