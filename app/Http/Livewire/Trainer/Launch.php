<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;


class Launch extends Component
{

    public $exam_id, $classroom_id, $groups, $quiz, $certificate_id, $min_points;
    public function render()
    {
        
        return view('livewire.trainer.launch')->layout('layouts.main');
    }

    private function resetInputFields() {
        
        $this->exam_id = null;
        $this->classroom_id  = null;
        $this->certificate_id  = null;
        $this->groups = null;
        $this->quiz  = null;
        $this->min_points  = null;
    }
    public function showForm() {
        $user = Auth::user();
        self::resetInputFields();
        $this->resetErrorBag();
        $this->groups = Classroom::all_items($user->id);
        $this->quiz = Exam::all_items($user->id);
        $this->dispatchBrowserEvent('openModal');
    }
    public function close()
    {
        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeUpdateModal');

    }
}
