<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Classroom;

class CoursesList extends Component
{
    public $courses, $class;

    public function mount($id)
    {
        $this->class = Classroom::find($id);
        $this->courses = $this->class->exams;
    }
    public function render()
    {
        return view('livewire.trainer.courses-list')->layout('layouts.main');
    }
}
