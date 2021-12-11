<?php

namespace App\Http\Livewire\Admin;
use App\Models\Land;

use Livewire\Component;

class Lands extends Component
{
    public function render()
    {
        return view('livewire.admin.lands', ['lands' => Land::paginate(15)]);
    }
}
