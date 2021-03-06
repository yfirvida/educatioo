<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;
use App\Models\Result;


class Results extends Component
{

    public $classroom, $classroom_id, $students, $current, $results;
    public $total = 0, $min_points = 0; 

    protected $coursess;
 

    public function mount()
    {
        $user = Auth::user();
        $this->groups = Classroom::all_items($user->id);
        
    }
    
    public function render()
    {

        $c = \Session::get('classroom');
        if($c){
            $this->classroom_id = $c;
            $this->classroom = Classroom::find($c);
            $this->coursess = Exam::listForResult($c);

                //calc the aproved
               /* $required = ($this->total * $this->min_points)/100;

                if($this->students){
                    foreach($this->students as $index => $student){
                        $status = "Pending"; $aproved = ""; $r = 0;
                        $result = $student->getResults($student->id, $this->current, $this->classroom_id);
                        if($result != null){
                            if($result->result >= $required){$aproved = "Aproved";}else{$aproved = "Failed";}
                            if($result->next_question == 0){$status = "Finished";}else{$status = "In progress";}
                            $r = $result->result;
                        }
                        
                        $this->students[$index]->result = $r;
                        $this->students[$index]->aproved = $aproved;
                        $this->students[$index]->status = $status;

                    }
                }*/

            }
            
        return view('livewire.trainer.results',['courses' => $this->coursess])->layout('layouts.main');
    }

    public function selectGroup($value)
    {
        \Session::put('classroom', $value);
        $this->classroom = Classroom::find($value);
        $this->coursess = Exam::listForResult($value);

    }

    public function archive($course, $class)
    {
        $this->course = Exam::find($course);

        if($this->course){
            $this->course->classrooms()->updateExistingPivot($class, ['archive' => 1]);
             session()->flash('message', 'Course Archived Successfully. To access the this Course go to Archive');
             $this->courses = Exam::listForResult($this->classroom_id);
        }


    }

    public function show($course, $class) {

        $this->classroom = Classroom::find($class);
        $this->students = $this->classroom->users;
        $this->current = $course;

        $pivot = $this->classroom->exams->find($course);
        if($pivot){
          $this->total = $pivot->pivot->total_points;
          $this->min_points = $pivot->pivot->min_points;
        }
        

        //calc the aproved
        $required = ($this->total * $this->min_points)/100;

        if($this->students){
            foreach($this->students as $index => $student){
                $status = "Pending"; $aproved = ""; $r = 0;
                $result = $student->getResults($student->id, $course, $class);
                if($result != null){
                    if($result->result >= $required){$aproved = "Aproved";}else{$aproved = "Failed";}
                    if($result->next_question == 0){$status = "Finished";}else{$status = "In progress";}
                    $r = $result->result;
                }
                
                $this->students[$index]->result = $r;
                $this->students[$index]->aproved = $aproved;
                $this->students[$index]->status = $status;

            }
        }

        
        $this->dispatchBrowserEvent('openModal');
    }
    public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 

    }

     public function detail($class, $course, $student) {

        $this->results = Result::getDetail($course, $student, $class);

        
        $this->dispatchBrowserEvent('openDModal');
    }
    public function closeD()
    {

        $this->dispatchBrowserEvent('closeDModal'); 

    }

}
