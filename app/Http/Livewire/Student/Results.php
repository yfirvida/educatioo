<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Classroom;
use App\Models\Result;

class Results extends Component
{
    public $classroom, $course, $user, $class_id, $course_id, $value, $total, $min, $aproved;

    public function mount()
    {
        $this->user = Auth::user();
        $this->class_id = \Session::get('class_id');
        $this->course_id = \Session::get('course_id');
        $this->classroom = Classroom::find($this->class_id);
        $this->course = Exam::find($this->course_id);

    }
    public function render()
    {
        $this->value = Result::getValue($this->course_id, $this->user->id, $this->class_id);
        $this->total = Exam::getTotalPoints($this->course_id, $this->class_id);
        $this->min = Exam::getMinPoints($this->course_id, $this->class_id);

        //calc the aproved
        $required = ($this->total * $this->min)/100;

        if($this->value >= $required){$this->aproved = "Aproved";}else{$this->aproved = "Failed";}

        return view('livewire.student.result')->layout('layouts.students');
    }
}
