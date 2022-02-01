<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;

class CoursePreview extends Component
{
    public function render()
    {
        return view('livewire.trainer.course-preview')->layout('layouts.main');
    }
}
