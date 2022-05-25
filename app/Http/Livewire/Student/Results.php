<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Classroom;
use App\Models\Result;

class Results extends Component
{
    public $classroom, $course, $user, $class_id, $course_id, $points, $total, $min, $aproved, $value;

    public function mount()
    {
        $this->user = Auth::user();
        $this->class_id = \Session::get('class_id');
        $this->course_id = \Session::get('course_id');
        $this->launch_id = \Session::get('launch_id');
        $this->classroom = Classroom::find($this->class_id);
        $this->course = Exam::find($this->course_id);

    }
    public function render()
    {
        $this->points = Result::getValue($this->launch_id, $this->user->id);
        $this->total = Exam::getTotalPoints($this->launch_id);
        $this->min = Exam::getMinPoints($this->launch_id);

        //calc the aproved
        $this->value = ($this->points * 100)/$this->total;
        $this->value = round($this->value);

        if($this->value >= $this->min){$this->aproved = "Passed";}else{$this->aproved = "Failed";}

        return view('livewire.student.result')->layout('layouts.students');
    }
}
