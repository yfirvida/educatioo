<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Classroom;

class CoursesList extends Component
{
    public $class;
    protected $exams;

    public function mount($id)
    {
        $this->class = Classroom::find($id);
        $this->exams = $this->class->exams();
    }
    public function render()
    {
        return view('livewire.trainer.courses-list' , ['courses' => $this->exams->paginate(10)])->layout('layouts.main');
    }
}
