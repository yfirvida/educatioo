<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;
use App\Models\Classroom;
use App\Models\Answer;
use App\Models\Question;

class ResultDetail extends Component
{
    public $class, $students, $questions, $answers;
    public $current_question;
    protected $launch_id, $exam;
    public function mount($launch_id)
    {
        $this->launch_id = $launch_id;
        \Session::put('launch_id', $this->launch_id);
        $exam = Exam::GetByLaunch($this->launch_id);

        $this->class = Classroom::find($exam[0]->class_id);

        //calc the aproved
        $required = ($exam[0]->total_points * $exam[0]->min_points)/100;


        $this->students = $this->class->users;
        if($this->students){
            foreach($this->students as $index => $student){
                $aproved = false; $r = 0;
                $result = $student->getResults($student->id, $this->launch_id);
                if($result != null){
                    if($result->result >= $required){$aproved = true;}
                    $r = round(($result->result * 100) / $exam[0]->total_points);
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

        $this->exam = Exam::find($exam[0]->id); 
        $this->questions = $this->exam->questions()->wherePivot('show_in_result', 1 )->get();
        
    }
    public function render()
    {
        $this->launch_id = \Session::get('launch_id');

        $exam = Exam::GetByLaunch($this->launch_id);
        $this->class = Classroom::find($exam[0]->class_id);

        //calc the aproved
        $required = ($exam[0]->total_points * $exam[0]->min_points)/100;


        $this->students = $this->class->users;
        if($this->students){
            foreach($this->students as $index => $student){
                $aproved = false; $r = 0;
                $result = $student->getResults($student->id, $this->launch_id);
                if($result != null){
                    if($result->result >= $required){$aproved = true;}
                    $r = round(($result->result * 100) / $exam[0]->total_points);
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

        $this->exam = Exam::find($exam[0]->id);
        $this->questions = $this->exam->questions()->wherePivot('show_in_result', 1 )->get();

        return view('livewire.trainer.result-detail', ['exam' => $this->exam])->layout('layouts.main');
    }

    public function showQuestion($id) 
    { 
        $this->current_question = Question::find($id);
        $this->answers = $this->current_question->answers()->get();
        $this->dispatchBrowserEvent('openModal');
    }

    public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 

    }
}
