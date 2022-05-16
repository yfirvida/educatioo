<?php

namespace App\Http\Livewire\Student;
use Illuminate\Support\Facades\Session;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Classroom;
use DateTime;
use DateTimeZone;
use App\Models\Result;

class Dashboard extends Component
{
    public $classroom, $course, $user, $next;


    public function render()
    {
        $class_id = \Session::get('class_id');
        $this->classroom = Classroom::find($class_id);
        $course_id = \Session::get('course_id');

        $now = new DateTime();
        $now->setTimeZone(new DateTimeZone('UTC'));
        $now = $now->format('Y-m-d H:i:s');

        $course = Exam::find($course_id); 
        $active = $course->classrooms()->where('utc_start', '<=', $now)->where('utc_end', '>=', $now)->get();

        $this->user = Auth::user();
        
        
        if($active->count()){
          $this->course = $course;
          \Session::put('launch_id', $active[0]->pivot->id);

          $this->next = Result::getNext($active[0]->pivot->id, $this->user->id );
        }

        return view('livewire.student.dashboard')->layout('layouts.students');
    }
}
