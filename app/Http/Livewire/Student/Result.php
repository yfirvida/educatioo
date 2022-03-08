<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class Result extends Component
{
    public function render()
    {
        return view('livewire.student.result')->layout('layouts.students');
    }
}
