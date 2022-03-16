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
            'url' => 'required|url'

        ]);

        $parts = parse_url($this->url);
        if (array_key_exists('query', $parts)) {
            parse_str($parts['query'], $query);
            if(array_key_exists('exam', $query)){
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
                session()->flash('message', 'Course Imported Successfully. To see this course go to Courses');
            }
        }
        else{
            session()->flash('error-message', 'This Url does not belong to any course');
        }

         
    }
}
