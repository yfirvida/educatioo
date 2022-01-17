<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;

class Classrooms extends Component
{
    public function render()
    {
        return view('livewire.trainer.classrooms')->layout('layouts.main');
    }
}
