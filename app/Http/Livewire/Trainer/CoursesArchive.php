<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;

class CoursesArchive extends Component
{
    public function render()
    {
        return view('livewire.trainer.courses-archive')->layout('layouts.main');
    }
}
