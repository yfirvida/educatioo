<?php

namespace App\Http\Livewire\Student;
use Illuminate\Support\Facades\Session;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Classroom;
use DateTime;
use DateTimeZone;

class Dashboard extends Component
{
    public $classroom, $course, $user;


    public function render()
    {
        $class_id = \Session::get('class_id');
        $this->classroom = Classroom::find($class_id);
        $course_id = \Session::get('course_id');

        $now = gmdate("Y-m-d H:i:s");

        $course = Exam::find($course_id); 
        $active = $course->classrooms()->where('start', '<=', $now)->where('end', '>=', $now)->get();

        
        
        if($active->count()){
          $this->course = $course;
        }
        $this->user = Auth::user();

        return view('livewire.student.dashboard')->layout('layouts.students');
    }
}
