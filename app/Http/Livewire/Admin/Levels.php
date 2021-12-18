<?php

namespace App\Http\Livewire\Admin;
use App\Models\Level;

use Livewire\Component;

class Levels extends Component
{
    public function render()
    {
        return view('livewire.admin.levels', ['levels' => Level::paginate(15)]);
    }
}
