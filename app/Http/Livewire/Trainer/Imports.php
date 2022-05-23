<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;
use App\Models\Import;
use Illuminate\Support\Facades\Auth;

class Imports extends Component
{
    public $url, $name;
    public $idReferences = [];
    public function render()
    {
        return view('livewire.trainer.imports')->layout('layouts.main');
    }

    public function import()
    {

        $validatedData = $this->validate([
            'name' => 'required',
            'url' => 'required|url'

        ]);

        $parts = parse_url($this->url);
        if (array_key_exists('query', $parts)) {
            parse_str($parts['query'], $query);
            if(array_key_exists('exam', $query) && array_key_exists('code', $query)){
                //first verify if the code is active
                $code = $query['code'];
                $course_id = $query['exam'];

                if(Import::verify($course_id, $code)){
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

                       $this->idReferences[$question->id] = $newQ->id;

                    }

                    $newExam->save();
                    foreach($newExam->questions as $question)
                    {
                       foreach($question->answers as $answer)
                        {
                            if (array_key_exists($answer->next_question, $this->idReferences)) {
                                $new = $this->idReferences[$answer->next_question];
                                $answer->update(['next_question'=> $new]);
                            }
                        } 
                        
                    }

                    session()->flash('message', 'Course Imported Successfully. To see this course go to Courses');
                    //desactivar el code
                    Import::deactive($course_id, $code);

                }
                else{
                   session()->flash('error-message', "This is code is expired or doesn't exist"); 
                }   
            }
            else{
               session()->flash('error-message', 'This Import  Url does not seem correct'); 
            }
            
        }
        else{
            session()->flash('error-message', 'This Url does not belong to any course');
        }

         
    }
}
