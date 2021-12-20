<?php

namespace App\Http\Livewire\Admin;
use App\Models\Level;

use Livewire\Component;

class Levels extends Component
{
	public $level;
    public $updateMode = false;

    

    public function render()
    {
        return view('livewire.admin.levels', ['levels' => Level::paginate(15)]);
    }

    private function resetInputFields() {
        
        $this->level = '';
    }

    public function showForm() {
        self::resetInputFields();
        $this->resetErrorBag();
    }


    public function store()
    {
        $validatedData = $this->validate([
            'level' => 'required',
        ]);

        Level::create($validatedData);

        session()->flash('message', 'Level Created Successfully.');

        $this->resetInputFields();

        $this->emit('levelStore'); // Close model to using to jquery

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $level = Level::where('id',$id)->first();
        $this->level_id = $id;
        $this->level = $level->level;
        
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();


    }

    public function update()
    {
        $validatedData = $this->validate([
            'level' => 'required',
        ]);

        if ($this->level_id) {
            $level = Level::find($this->level_id);
            $level->update([
                'level' => $this->level,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Level Updated Successfully.');
            $this->resetInputFields();

        }
    }

    public function delete($id)
    {
        if($id){
            Level::where('id',$id)->delete();
            session()->flash('message', 'Level Deleted Successfully.');
        }
    }
}

