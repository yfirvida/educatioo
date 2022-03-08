<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Answer;
use App\Models\Question;

class EditCourse extends Component
{
    public $course;
    public $name, $description, $level_id;
    public $levels;
    public $questions;

    protected $rules = [
        'questions.*.answers.*.next_question' => 'nullable',
        'questions.*.answers.*.answer' => 'nullable',
        'questions.*.answers.*.correct' => 'nullable',
        'questions.*.latest_question' => 'nullable',
        'questions.*.show_in_result' => 'nullable',

    ];

    public function mount($id)
    {
        $this->course = Exam::find($id);
        $this->questions = $this->course->questions;
        $this->name = $this->course->name;
        $this->description = $this->course->description;
        $this->level_id = $this->course->level_id;
        foreach($this->questions as $q){
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        }
    }

    public function render()
    {
        $this->levels = Level::all_items();
        return view('livewire.trainer.edit-course',['levels', $this->levels])->layout('layouts.main');
    }


    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'level_id' => 'required'
        ]);

    
        $this->course->update([
            'name' => $this->name,
            'description' => $this->description,
            'level_id' => $this->level_id
        ]);

        //update the pivot table exam_question
        foreach($this->questions as $q){
            $this->course->questions()->updateExistingPivot($q->id, ['latest_question' => $q->latest_question, 'show_in_result' => $q->show_in_result]);
 
            $answers = $q->answers;
            foreach($q->answers as $a){ 
                $ans = Answer::find($a->id);
                $ans->update(['answer' => $a->answer,
                    'next_question' => $a->next_question,
                    'correct' => $a->correct]);
            }

        }      


        $this->course->refresh();
        session()->flash('message', 'Course Updated Successfully.');

    }


     //new question

    private function resetInputQFields() {
        
        $this->nameq = '';
        $this->q_value = '';
        $this->explanation = '';
        $this->question_name = '';
        $this->image = '';
        $this->showR = false;
        $this->latestQ = false;
    }

    public function showForm() {
        self::resetInputQFields();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openModal');
    }

    public function store()
    {

        $validatedData = $this->validate([
            'nameq' => 'required',
            'q_value' => 'required',
            'explanation' => 'nullable',
            'question_name' => 'required',
            'image' => 'nullable'

        ]);

        $questionn = Question::create(['identifier' => $this->nameq,
            'value' => $this->q_value,
            'intro' => $this->explanation,
            'question' => $this->question_name,
            'image' => $this->image
        ]);

        $this->question_id = $questionn->id;

        $this->course->questions()->attach($questionn->id, ['show_in_result' => $this->showR, 'latest_question' => $this->latestQ]); 

        $this->course->refresh();
        $this->questions = $this->course->questions; 
        foreach($this->questions as $q){
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        }  
    
        $this->dispatchBrowserEvent('openAnswers'); // Close modal using jquery
        //self::resetInputFields();
        //$this->dispatchBrowserEvent('closeModal'); // Close modal using jquery

    }
    public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeUpdateModal');

    }
    //new question

    //new answer
    private function resetInputAFields() {
        
        $this->answer  = '';
        $this->next_question  = null;
        $this->imageA  = '';
        $this->right  = false;

    }

    public function showAForm() {
        self::resetInputAFields();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openAModal');
    }

     public function showA2Form($id) {
        $this->question_id = $id;
        self::resetInputAFields();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openAModal');
    }

    public function saveAnswer()
    {

        $validatedData = $this->validate([
            'answer' => 'required',
            'next_question' => 'nullable',
            'imageA' => 'nullable',
            'right' => 'nullable'

        ]);

        $answer = Answer::create(['answer' => $this->answer,
            'next_question' => $this->next_question,
            'correct' => $this->right,
            'question_id' => $this->question_id,
            'image' => $this->imageA,
        ]);
        
        $this->course->refresh();
        $this->questions = $this->course->questions;
        foreach($this->questions as $q){
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        }  
        self::resetInputAFields();

        session()->flash('message', 'Answer Added Successfully.');

    }

    
    public function closeA()
    {

        $this->dispatchBrowserEvent('closeAModal'); 


    }

}
