<?php

namespace App\Http\Livewire\Admin;
use App\Models\User;

use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        $t_quiz = 0;
        return view('livewire.admin.users', ['trainers' => User::where('role', 'admin')->paginate(15), 'total_quiz' => $t_quiz]);
    }
}
