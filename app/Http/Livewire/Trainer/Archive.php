<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class Archive extends Component
{
    protected $courses;
    public function mount()
    {
        $user = Auth::user();
        $this->courses = Exam::archive($user->id);
        
    }
    public function render()
    {
        return view('livewire.trainer.archive',['courses'=>$this->courses])->layout('layouts.main');
    }
}
