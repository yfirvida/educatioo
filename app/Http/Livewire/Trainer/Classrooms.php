<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Level;

class Classrooms extends Component
{
    public $name, $level_id;
    public $levels;
    public function render()
    {
        return view('livewire.trainer.classrooms')->layout('layouts.main');
    }
    private function resetInputFields() {
        
        $this->name = '';
        $this->level_id  = null;
    }
    public function showForm() {
        self::resetInputFields();
        $this->resetErrorBag();
        $this->levels = Level::all_items();
        $this->dispatchBrowserEvent('openModal');
    }
    public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeUpdateModal');

    }
}
