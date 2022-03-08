<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class Quiz extends Component
{
    public function render()
    {
        return view('livewire.student.quiz')->layout('layouts.students');
    }
}
