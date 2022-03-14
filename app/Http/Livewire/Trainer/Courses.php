<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Courses extends Component
{
    public $current;
    public function render()
    {
        $user = Auth::user();
        $courses = Exam::all_items($user->id);
        return view('livewire.trainer.courses', ['courses' => $courses])->layout('layouts.main');
    }

    public function confirm($id)
    {
        $this->current = $id;
        $this->dispatchBrowserEvent('openModal');

    }
    public function share($id)
    {
        $this->current = $id;
        $this->dispatchBrowserEvent('openSModal');

    }

     public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeSModal'); 

    }


    public function delete($id)
    {
        $course = Exam::find($id);


        foreach($course->questions as $q){
            $q->answers()->delete(); 
        } 
        $course->questions()->detach();
        $course->questions()->delete();  
        $course->delete();

        session()->flash('message', 'Course Deleted Successfully.');
        $this->current = null;
        $this->dispatchBrowserEvent('closeModal'); 


    }


}
