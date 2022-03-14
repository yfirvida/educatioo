<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class Import extends Component
{
    public $url, $name;
    public function render()
    {
        return view('livewire.trainer.import')->layout('layouts.main');
    }

    public function import()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'url' => 'required'

        ]);

        $parts = parse_url($this->url);
        parse_str($parts['query'], $query);
        $course_id = $query['exam'];
        $user = Auth::user();

        $exam = Exam::find($course_id);

        $newExam = $exam->replicate();
        $newExam->name = $this->name;
        $newExam->author = $user->id;

        $newExam->push();
         
        foreach($exam->questions as $question)
        {

           $newQ = $question->replicateRow();
           $newExam->questions()->attach($newQ->id, ['show_in_result' => $question->exams[0]->pivot['show_in_result'], 'latest_question' => $question->exams[0]->pivot['latest_question'], 'first_question' => $question->exams[0]->pivot['first_question']]);

        }

        $newExam->save();


       /* $q = Question::find($id);
        $newQ = $q->replicateRow();
        $this->course->questions()->attach($newQ->id, ['show_in_result' => $q->exams[0]->pivot['show_in_result'], 'latest_question' => $q->exams[0]->pivot['latest_question'], 'first_question' => $q->exams[0]->pivot['first_question']]);

        $this->course->refresh();
        $this->questions = $this->course->questions; 
        foreach($this->questions as $q){
            $q->first_question = $q->pivot['first_question'];
            $q->latest_question = $q->pivot['latest_question'];
            $q->show_in_result  =  $q->pivot['show_in_result'];    
        } */

        session()->flash('message', 'Course Imported Successfully. To see this course go to Courses'); 
    }
}
