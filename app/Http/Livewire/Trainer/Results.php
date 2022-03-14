<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use DateTime;

class Results extends Component
{

    public $classroom, $classroom_id, $courses;

    public function mount()
    {
        $user = Auth::user();
        $this->groups = Classroom::all_items($user->id);
    }
    
    public function render()
    {
        return view('livewire.trainer.results')->layout('layouts.main');
    }

    public function selectGroup($value)
    {
        $this->classroom = Classroom::find($value);
        $this->courses = Exam::listForResult($value);

        if($this->courses){
            foreach($this->courses as $index => $course){
                $pivot = $course->classrooms->find($value);
                $this->courses[$index]->start = $pivot->pivot->start;
                $this->courses[$index]->end = $pivot->pivot->end;

            }
        }
    }

}
