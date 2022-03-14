<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use DateTime;

class Results extends Component
{

    public $classroom, $classroom_id, $courses, $students, $total;

    public function mount()
    {
        $user = Auth::user();
        $this->groups = Classroom::all_items($user->id);
    }
    
    public function render()
    {
        return view('livewire.trainer.results')->layout('layouts.main');
    }

    public function selectGroup($value)
    {
        $this->classroom = Classroom::find($value);
        $this->courses = Exam::listForResult($value);

        if($this->courses){
            foreach($this->courses as $index => $course){
                $pivot = $course->classrooms->find($value);
                $this->courses[$index]->start = $pivot->pivot->start;
                $this->courses[$index]->end = $pivot->pivot->end;

            }
        }
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

        $pivot = $this->classroom->exams->find($course);
        $this->total = $pivot->pivot->total_points;

        //calc the aproved
        $required = ($this->total * $pivot->pivot->min_points)/100;

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

}
