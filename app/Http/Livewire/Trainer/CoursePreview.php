<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;

class CoursePreview extends Component
{
    public $course;
    public $name, $description, $level;
    public $questions;

    public function mount($id)
    {
        $this->course = Exam::find($id);
        $this->name = $this->course->name;
        $this->description = $this->course->description;
        $this->level = $this->course->level->level;
        $this->questions = $this->course->questions;

       
    }

    public function render()
    {
        return view('livewire.trainer.course-preview')->layout('layouts.main');
    }

}
