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
    public $classroom, $course, $user, $class_id, $course_id, $current, $next, $latest, $answers, $value;

    protected $rules = [
        'answers.*.resp' => 'nullable',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->class_id = \Session::get('class_id');
        $this->course_id = \Session::get('course_id');
        $this->classroom = Classroom::find($this->class_id);
        $this->course = Exam::find($this->course_id);
        $this->next = 0;
    }

    public function render()
    {

        if(!$this->next){ //first question
            $this->current = Question::firstQuestion($this->course_id);
            $this->value = 0;
        }
        else{ //other question

            $this->current = Question::find($this->next);
            $this->value = Result::getValue($this->course_id, $this->user->id, $this->class_id);

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
                if($a->correct){ 
                    $this->value+= $this->current->value;
                }
                if(!$this->latest){$this->next = $a->next_question;}else{$this->next = 0;}

                Result::updateOrCreate(
                    ['user_id' => $this->user->id, 'exam_id' => $this->course_id, 'classroom_id' => $this->class_id],
                    ['result' => $this->value, 'next_question' => $this->next]
                );
              }      
        }

        if($this->latest){ redirect()->route('result');}

    }
}
