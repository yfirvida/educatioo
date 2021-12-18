<?php

namespace App\Http\Livewire\Admin;
use App\Models\Plan;

use Livewire\Component;

class Plans extends Component
{
    public function render()
    {
        return view('livewire.admin.plans', ['plans' => Plan::paginate(15)]);
    }
}
