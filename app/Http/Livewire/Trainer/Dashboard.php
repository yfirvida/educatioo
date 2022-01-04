<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.trainer.dashboard')->layout('layouts.main');
    }
}
