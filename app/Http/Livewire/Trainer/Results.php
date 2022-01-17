<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;

class Results extends Component
{
    public function render()
    {
        return view('livewire.trainer.results')->layout('layouts.main');
    }
}
