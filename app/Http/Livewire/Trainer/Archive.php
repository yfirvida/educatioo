<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;

class Archive extends Component
{
    public function render()
    {
        return view('livewire.trainer.archive')->layout('layouts.main');
    }
}
