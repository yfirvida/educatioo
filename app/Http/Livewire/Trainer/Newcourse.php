<?php

namespace App\Http\Livewire\Trainer;
use App\Models\Question;
use App\Models\Answer;

use Livewire\Component;

class Newcourse extends Component
{
    
    public $name, $question, $q_value, $image;
    public function render()
    {
        return view('livewire.trainer.newcourse')->layout('layouts.main');
    }
    private function resetInputFields() {
        
        $this->name         = '';
        $this->question          = '';
        $this->q_value    = '';
        $this->image    = '';
    }

    public function showForm() {
        self::resetInputFields();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openModal');
    }

    public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeUpdateModal');


    }
}
