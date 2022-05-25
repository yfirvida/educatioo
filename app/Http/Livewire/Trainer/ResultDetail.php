<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;
use App\Models\Classroom;
use App\Models\Answer;

class ResultDetail extends Component
{
    public $exam, $class, $students, $questions;
    public function mount($launch_id)
    {
        $this->exam = Exam::GetByLaunch($launch_id);
        $this->class = Classroom::find($this->exam[0]->class_id);

        //calc the aproved
        $required = ($this->exam[0]->total_points * $this->exam[0]->min_points)/100;


        $this->students = $this->class->users;
        if($this->students){
            foreach($this->students as $index => $student){
                $aproved = false; $r = 0;
                $result = $student->getResults($student->id, $launch_id);
                if($result != null){
                    if($result->result >= $required){$aproved = true;}
                    $r = round(($result->result * 100) / $this->exam[0]->total_points);
                    $ans = [];
                    foreach($result->detail as $q => $a){
                        
                        $ans[$q] = Answer::find($a);
                    }
                    $this->students[$index]->detail = $ans;
                }
                
                $this->students[$index]->total = $r;
                $this->students[$index]->aproved = $aproved;


            }
        }

        $exam = Exam::find($this->exam[0]->id);
        $this->questions = $exam->questions()->wherePivot('show_in_result', 1 )->get();
        
    }
    public function render()
    {
        return view('livewire.trainer.result-detail')->layout('layouts.main');
    }
}
