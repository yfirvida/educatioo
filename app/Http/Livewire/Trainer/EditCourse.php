<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class EditCourse extends Component
{
    use WithFileUploads;

    public $course;
    public $name, $description, $level_id;
    public $levels;
    public $questions, $current;
    public $uimage;
    protected $listeners = ['fileUpload'];

    protected $rules = [
        'questions.*.answers.*.next_question' => 'nullable',
        'questions.*.answers.*.answer' => 'nullable',
        'questions.*.answers.*.correct' => 'nullable',
        'questions.*.first_question' => 'nullable',
        'questions.*.latest_question' => 'nullable',
        'questions.*.show_in_result' => 'nullable',
        'questions.*.image' => 'image|mimes:jpeg,jpg,png,gif|max:500|nullable',

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
            'image' => 'nullable'

        ]);

        $questionn = Question::create(['identifier' => $this->nameq,
            'value' => $this->q_value,
            'intro' => $this->explanation,
            'question' => $this->question_name,
            'image' => $this->image
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
            $q->first_question = $q->pivot['first_question'];
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
        $this->image = $q->image;
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
            'image' => 'nullable'

        ]);
        $q = Question::find($id);
        $q->update(['identifier' => $this->nameq,
            'value' => $this->q_value,
            'intro' => $this->explanation,
            'question' => $this->question_name,
            'image' => $this->image
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

    public function uploadImage(Request $request){

       /* foreach($this->questions as $q){
            dump($q->image); die();
        }*/
        dump($this->uimage); die();

        /*$this->validate([
            'profile_image' => 'image|mimes:jpeg,jpg,png,gif|max:500|required'
        ]);*/
       /* $images = [
            'name' => $this->profile_image->getClientOriginalName(),
            'path' => $this->profile_image->getRealPath(),
            'extension' => $this->profile_image->getClientOriginalExtension(),
        ];
        $filenameSmall = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' .  $images['extension'];
        $path = public_path('uploads/' . $filenameSmall);
        ImageManagerStatic::make( $images['path'])->orientate()->fit(300, 300, function ($constraint) {
            $constraint->upsize();

        },'top')->save($path);

        $user = User::find(Auth::user()->id);

        if (!empty($user->image)){
            @unlink(public_path("uploads/".$user->image.""));
        }

        $user->image =  $filenameSmall;
        $user->save();
        $this->uploaded = true;

        $this->profile_image  = $user->image;
        $this->emit('uploadedImage');
        session()->flash('successImage', __('Your profile image has been uploaded succesfully.'));*/
    }

}
