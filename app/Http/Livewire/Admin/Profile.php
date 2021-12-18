<?php

namespace App\Http\Livewire\Admin;
use App\Models\User;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        
        $user = User::find(1);
        return view('livewire.admin.profile', ['user' => $user]);
    }
}
