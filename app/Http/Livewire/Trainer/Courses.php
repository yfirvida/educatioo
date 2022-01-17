<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;

class Courses extends Component
{
    public function render()
    {
        return view('livewire.trainer.courses')->layout('layouts.main');
    }
}
