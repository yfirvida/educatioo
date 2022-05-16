<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Classroom;
use App\Models\Question;
use App\Models\Result;

class Quiz extends Component
{
    public $classroom, $course, $user, $class_id, $course_id, $current, $next, $latest, $answers, $value, $detail, $launch_id;

    protected $rules = [
        'answers.*.resp' => 'nullable',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->class_id = \Session::get('class_id');
        $this->course_id = \Session::get('course_id');
        $this->launch_id = \Session::get('launch_id');
        $this->classroom = Classroom::find($this->class_id);
        $this->course = Exam::find($this->course_id);
        $this->next = Result::getNext($this->launch_id, $this->user->id );

    }

    public function render()
    {

        if($this->next == -1){ //first question
            $this->current = Question::firstQuestion($this->course_id);
            $this->value = 0;
        }
        else{ //other question

            $this->current = Question::find($this->next);
            $this->value = Result::getValue($this->launch_id, $this->user->id);
            $this->detail = Result::getDetail($this->launch_id, $this->user->id);

        }

        $rel = $this->current->exams;
        $this->latest = $rel[0]->pivot->latest_question;

        $this->answers = $this->current->answers;


        return view('livewire.student.quiz')->layout('layouts.students');
    }

    public function store()
    {

        foreach($this->answers as $a){
              if($a->resp == 1){
                $this->detail[$this->current->id] = $a->id;
                if($a->correct){ 
                    //check if the question is show in results
                    $rel = $this->current->exams;
                    $show = $rel[0]->pivot->show_in_result;
                    if($show){
                        $this->value+= $this->current->value;
                    }
                }
                if(!$this->latest){$this->next = $a->next_question;}else{$this->next = 0;}
                

                Result::updateOrCreate(
                    ['user_id' => $this->user->id, 'exam_id' => $this->course_id, 'classroom_id' => $this->class_id, 'launch_id' => $this->launch_id],
                    ['result' => $this->value, 'next_question' => $this->next, 'detail' => $this->detail]
                );
              }      
        }

        if($this->latest){ redirect()->route('result');}

    }
}
