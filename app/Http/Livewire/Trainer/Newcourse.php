<?php

namespace App\Http\Livewire\Trainer;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use Livewire\Component;

class Newcourse extends Component
{
    
    use WithFileUploads;

    public $name, $description, $author, $level_id;
    public $nameq, $explanation, $question_name, $showR, $latestQ, $firstQ; 
    public $levels, $questions;
    public $answer, $next_question, $right, $answerImage;
    public $course_id = 0;
    public $question_id, $current;
    public $q_value = 0;

    public $image;
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

    public function mount()
    {
        $course = Exam::find($this->course_id);
        if($course): 
            $this->name = $course->name;
            $this->description = $course->description;
            $this->questions = $course->questions; 
            foreach($this->questions as $q){
                $q->first_question = $q->pivot['first_question'];
                $q->latest_question = $q->pivot['latest_question'];
                $q->show_in_result  =  $q->pivot['show_in_result'];    
            }
        endif;
    }

    public function render()
    {
        $this->levels = Level::all_items();
        return view('livewire.trainer.newcourse', ['levels' => $this->levels])->layout('layouts.main');
    }
    private function resetInputFields() {
        
        $this->name         = '';
        $this->description          = '';
        $this->level_id          = '';
    }

    //new question

    private function resetInputQFields() {
        
        $this->nameq = '';
        $this->q_value = 0;
        $this->explanation = '';
        $this->question_name = '';
        $this->image = '';
        $this->showR = false;
        $this->firstQ = false;
        $this->latestQ = false;
    }

    public function showForm() {
        self::resetInputQFields();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openModal');
    }

    public function save()
    {
        
        $user = Auth::user();
        if($this->course_id == 0){ //need save the course first
            $validatedData = $this->validate([
                'name' => 'required | unique:exams',
                'description' => 'required',
                'level_id' => 'required',
                ]);

            $course = Exam::create(['name' => $this->name,
                'description' => $this->description,
                'author' => $user->id,
                'level_id' => $this->level_id
            ]);
        }
        else{
            $course = Exam::find($this->course_id);
        }

        if($course){
            $this->course_id = $course->id; 
            if($this->questions != null){
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

                foreach($this->questions as $q){   
                    $course->questions()->updateExistingPivot($q->id, ['latest_question' => $q->latest_question, 'show_in_result' => $q->show_in_result, 'first_question' => $q->first_question]);
         
                    $answers = $q->answers;
                    foreach($q->answers as $a){ 
                        $ans = Answer::find($a->id);
                        $ans->update(['answer' => $a->answer,
                            'next_question' => $a->next_question,
                            'correct' => $a->correct]);
                        }
                    }

                    $this->questions = $course->questions; 
                    foreach($this->questions as $q){
                        $q->first_question = $q->pivot['first_question'];
                        $q->latest_question = $q->pivot['latest_question'];
                        $q->show_in_result  =  $q->pivot['show_in_result'];    
                    }     
                }
            
            }
            $course->refresh();
            session()->flash('message', 'Course Saved Successfully.');


    }
    public function store()
    {
        $user = Auth::user();
        //check if the course is saved
        if($this->course_id == 0){ //need save the course first
            $validatedData = $this->validate([
                'name' => 'required | unique:exams',
                'description' => 'required',
                'level_id' => 'required',
                ]);

            $course = Exam::create(['name' => $this->name,
                'description' => $this->description,
                'author' => $user->id,
                'level_id' => $this->level_id
            ]);

            $this->course_id = $course->id;

        }
        else{
            $course = Exam::find($this->course_id);
        }

        $validatedData = $this->validate([
            'nameq' => 'required',
            'q_value' => 'required',
            'explanation' => 'nullable',
            'question_name' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:500|nullable'

        ]);

        if($this->image != ''){
            //save images for questions
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

        $course->questions()->attach($questionn->id, ['show_in_result' => $this->showR, 'latest_question' => $this->latestQ, 'first_question' => $this->firstQ]); 


        $course->refresh();
        $this->questions = $course->questions; 
        foreach($this->questions as $q){
            $q->first_question = $q->pivot['first_question'];
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        }  
    
        $this->dispatchBrowserEvent('openAnswers'); // Close modal using jquery
       
        //$this->dispatchBrowserEvent('closeModal'); // Close modal using jquery

    }

    public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeUpdateModal');

    }

    public function Is_show($id, $index)
    {
        $course = Exam::find($this->course_id);
        
        $q = Question::find($id);
        $course->questions()->updateExistingPivot($q->id, ['show_in_result' => $this->questions[$index]->show_in_result]);

    }
    public function Is_last($id, $index)
    {
        $course = Exam::find($this->course_id);
        if($this->questions[$index]->latest_question == 1){
            foreach($this->questions as $ind => $e){
                if($e->latest_question != 0 && $ind != $index) {
                    $e->latest_question = 0;
                    $course->questions()->updateExistingPivot($e->id, ['latest_question' => $e->latest_question]);
                }
            } 
        } 
        $q = Question::find($id);
        $course->questions()->updateExistingPivot($q->id, ['latest_question' => $this->questions[$index]->latest_question]);

    }
    public function Is_first($id, $index)
    {
        $course = Exam::find($this->course_id);
        if($this->questions[$index]->first_question == 1){
            foreach($this->questions as $ind => $e ){
                if($e->first_question != 0 && $ind != $index) {
                    $e->first_question = 0; 
                    $course->questions()->updateExistingPivot($e->id, ['first_question' => $e->first_question]);
                }
            }  
        }

        $q = Question::find($id);
        $course->questions()->updateExistingPivot($q->id, ['first_question' => $this->questions[$index]->first_question]);
        

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
            'answerImage' => 'image|mimes:jpeg,jpg,png,gif|max:500|nullable',
            'right' => 'nullable'

        ]);

        if($this->answerImage != ''){
            //save image
                $name       = substr(md5(microtime() . rand(0, 9999)), 0, 20);
                $extension  = $this->answerImage->getClientOriginalExtension();
                $filename   = $name .'.'. $extension;
                $path       = 'public/answers';
                $url_image  = $storage  = 'storage/answers/'.$filename;
                $this->answerImage->storeAs($path, $filename);
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

        $course = Exam::find($this->course_id);
        $this->questions = $course->questions;
        foreach($this->questions as $q){
            $q->first_question = $q->pivot['first_question'];
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        }  
        self::resetInputAFields();

    }

    
    public function closeA()
    {
        self::resetInputAFields();
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


        $course = Exam::find($this->course_id);
        $this->questions = $course->questions;
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

        $course = Exam::find($this->course_id);
        $this->questions = $course->questions; 
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

        $course = Exam::find($this->course_id);
        $course->questions()->attach($newQ->id, ['show_in_result' => $q->exams[0]->pivot['show_in_result'], 'latest_question' => $q->exams[0]->pivot['latest_question'], 'first_question' => $q->exams[0]->pivot['first_question']]);

        
        $this->questions = $course->questions; 
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
