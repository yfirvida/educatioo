<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;

class EditCourse extends Component
{
    public function render()
    {
        return view('livewire.trainer.edit-course')->layout('layouts.main');
    }
}
