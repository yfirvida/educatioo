<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditCourse extends Component
{
    use WithFileUploads;

    public $course;
    public $name, $description, $level_id;
    public $levels;
    public $questions, $current;
    public $image;
    public $answerImage;
    public $images_temp = [];
    public $index_question;

    public $imagesA_temp = [];
    public $index_answerID;

    protected $listeners = ['fileUpload'];

    protected $rules = [
        'questions.*.answers.*.next_question' => 'nullable',
        'questions.*.answers.*.answer' => 'nullable',
        'questions.*.answers.*.correct' => 'nullable',
        'questions.*.first_question' => 'nullable',
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
            $q->first_question = $q->pivot['first_question'];
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
        
        //save images for questions
        foreach ($this->questions as $key => $q) {
            if (array_key_exists($key, $this->images_temp)) {
                $name       = date('YmdHis').$key;
                $extension  = $this->images_temp[$key]->getClientOriginalExtension();
                $filename   = $name .'.'. $extension;
                $path       = 'public/questions';
                $url_image  = $storage  = 'storage/questions/'.$filename;
                $this->images_temp[$key]->storeAs($path, $filename);

                
                $question = Question::find($q->id);
                $question->update(['image' => $filename]);
            }

            foreach($q->answers as $a){ 
                if (array_key_exists($a->id, $this->imagesA_temp)) {
                    $name       = date('YmdHis').$a->id;
                    $extension  = $this->imagesA_temp[$a->id]->getClientOriginalExtension();
                    $fname   = $name .'.'. $extension;
                    $path       = 'public/answers';
                    $url_image  = $storage  = 'storage/answers/'.$fname;
                    $this->imagesA_temp[$a->id]->storeAs($path, $fname);

                    $ans = Answer::find($a->id);
                    $ans->update(['image' => $fname]);
                }
            }
        }

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
            $this->course->questions()->updateExistingPivot($q->id, ['latest_question' => $q->latest_question, 'show_in_result' => $q->show_in_result, 'first_question' => $q->first_question]);
 
            $answers = $q->answers;
            foreach($q->answers as $a){ 
                $ans = Answer::find($a->id);
                $ans->update(['answer' => $a->answer,
                    'next_question' => $a->next_question,
                    'correct' => $a->correct]);
            }

        }      


        $this->course->refresh();
        $images_temp = array();
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
        $this->firstQ = false;
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
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:500|nullable'

        ]);

        if($this->image != ''){
            //save image
                $name       = substr(md5(microtime() . rand(0, 9999)), 0, 20);
                $extension  = $this->image->getClientOriginalExtension();
                $filename   = $name .'.'. $extension;
                $path       = 'public/questions';
                $url_image  = $storage  = 'storage/questions/'.$filename;
                $this->image->storeAs($path, $filename);
        }
        else{
            $filename = null;
        }

        $questionn = Question::create(['identifier' => $this->nameq,
            'value' => $this->q_value,
            'intro' => $this->explanation,
            'question' => $this->question_name,
            'image' => $filename
        ]);

        $this->question_id = $questionn->id;

        $this->course->questions()->attach($questionn->id, ['show_in_result' => $this->showR, 'latest_question' => $this->latestQ, 'first_question' => $this->firstQ ]); 

        $this->course->refresh();
        $this->questions = $this->course->questions; 
        foreach($this->questions as $q){
            $q->first_question = $q->pivot['first_question'];
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
        $this->dispatchBrowserEvent('closeUpdateQModal');

    }

    public function Is_show($id, $index)
    {
        
        $q = Question::find($id);
        $this->course->questions()->updateExistingPivot($q->id, ['show_in_result' => $this->questions[$index]->show_in_result]);

    }
    public function Is_last($id, $index)
    {
        if($this->questions[$index]->latest_question == 1){
            foreach($this->questions as $ind => $e){
                if($e->latest_question != 0 && $ind != $index) {
                    $e->latest_question = 0;
                    $this->course->questions()->updateExistingPivot($e->id, ['latest_question' => $e->latest_question]);
                }
            } 
        } 
        $q = Question::find($id);
        $this->course->questions()->updateExistingPivot($q->id, ['latest_question' => $this->questions[$index]->latest_question]);

    }
    public function Is_first($id, $index)
    {
        if($this->questions[$index]->first_question == 1){
            foreach($this->questions as $ind => $e ){
                if($e->first_question != 0 && $ind != $index) {
                    $e->first_question = 0; 
                    $this->course->questions()->updateExistingPivot($e->id, ['first_question' => $e->first_question]);
                }
            }  
        }

        $q = Question::find($id);
        $this->course->questions()->updateExistingPivot($q->id, ['first_question' => $this->questions[$index]->first_question]);
        

    }
    //new question

    //new answer
    private function resetInputAFields() {
        
        $this->answer  = '';
        $this->next_question  = null;
        $this->answerImage  = '';
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
            'imageA' => 'image|mimes:jpeg,jpg,png,gif|max:500|nullable',
            'right' => 'nullable'

        ]);

        if($this->imageA != ''){
            //save image
                $name       = substr(md5(microtime() . rand(0, 9999)), 0, 20);
                $extension  = $this->imageA->getClientOriginalExtension();
                $filename   = $name .'.'. $extension;
                $path       = 'public/answers';
                $url_image  = $storage  = 'storage/answers/'.$filename;
                $this->imageA->storeAs($path, $filename);
        }
        else{
            $filename = null;
        }

        $answer = Answer::create(['answer' => $this->answer,
            'next_question' => $this->next_question,
            'correct' => $this->right,
            'question_id' => $this->question_id,
            'image' => $filename,
        ]);

        $this->course->refresh();
        $this->questions = $this->course->questions;
        foreach($this->questions as $q){
            $q->first_question = $q->pivot['first_question'];
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        }  
        self::resetInputAFields();

        session()->flash('message', 'Answer Added Successfully.');

    }

    
    public function closeA()
    {
        self::resetInputQFields();
        $this->dispatchBrowserEvent('closeAModal'); 


    }

    //delete question
    public function confirm($id)
    {
        $this->current = $id;
        $this->dispatchBrowserEvent('openConfirmModal');

    }

     public function closeConfirm()
    {

        $this->dispatchBrowserEvent('closeConfirmModal'); 

    }

    public function deleteQuestion($id)
    {
        $q = Question::find($id);
        $q->answers()->delete(); 
        $q->exams()->detach();
        $q->delete();


        $this->course->refresh();
        $this->questions = $this->course->questions;
        foreach($this->questions as $q){
            $q->first_question = $q->pivot['first_question'];
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        }  
        session()->flash('message', 'Question Deleted Successfully.');
        
        $this->dispatchBrowserEvent('closeConfirmModal'); 

    }

    //update question

    public function editQ($id) {

        $q = Question::find($id);
        $this->current = $id;
        $this->nameq = $q->identifier;
        $this->q_value = $q->value;
        $this->explanation = $q->intro;
        $this->question_name = $q->question;
        $this->showR = false;
        $this->latestQ = false;
        
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openUpdateQModal');
    }

    public function updateQ($id)
    {

        $validatedData = $this->validate([
            'nameq' => 'required',
            'q_value' => 'required',
            'explanation' => 'nullable',
            'question_name' => 'required',

        ]);
        $q = Question::find($id);
        $q->update(['identifier' => $this->nameq,
            'value' => $this->q_value,
            'intro' => $this->explanation,
            'question' => $this->question_name,
        ]);

        $this->course->refresh();
        $this->questions = $this->course->questions; 
        foreach($this->questions as $q){
            $q->first_question = $q->pivot['first_question'];
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        }  
        
        self::resetInputQFields();
        $this->dispatchBrowserEvent('closeUpdateQModal'); // Close modal using jquery

    }

    public function copy($id)
    {
        $q = Question::find($id);
        $newQ = $q->replicateRow();
        $this->course->questions()->attach($newQ->id, ['show_in_result' => $q->exams[0]->pivot['show_in_result'], 'latest_question' => $q->exams[0]->pivot['latest_question'], 'first_question' => $q->exams[0]->pivot['first_question']]);

        $this->course->refresh();
        $this->questions = $this->course->questions; 
        foreach($this->questions as $q){
            $q->first_question = $q->pivot['first_question'];
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        } 

        session()->flash('message', 'Question Copied Successfully.'); 
    }
    public function indexImage($index){
        $this->index_question = $index;
    }

    public function updatedImage($value)
    {
        $this->validate([
            'image' => 'mimes:jpeg,jpg,png,gif|max:500|required|image'
        ]);
        $this->images_temp[$this->index_question] = $value;
    }

    public function indexImageA($id){
        $this->index_answerID = $id;
    }

    public function updatedAnswerImage($value)
    {
        $this->validate([
            'answerImage' => 'mimes:jpeg,jpg,png,gif|max:500|required|image'
        ]);
        $this->imagesA_temp[$this->index_answerID] = $value;
       


    }
}
