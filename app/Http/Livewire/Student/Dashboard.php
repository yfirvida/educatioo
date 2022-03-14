<?php

namespace App\Http\Livewire\Student;
use Illuminate\Support\Facades\Session;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Classroom;

class Dashboard extends Component
{
    public $classroom, $course, $user;


    public function render()
    {
        $class_id = \Session::get('class_id');
        $this->classroom = Classroom::find($class_id);
        $this->course = Exam::currectExam($class_id);
        if($this->course){
         \Session::put('course_id', $this->course->id);
        }
        $this->user = Auth::user();

        return view('livewire.student.dashboard')->layout('layouts.students');
    }
}
