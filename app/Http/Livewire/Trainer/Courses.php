<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Import;
use App\Models\Plan;


class Courses extends Component
{
    public $current, $code, $plan_id = 1;
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
        $this->code = bin2hex(random_bytes(4));

        Import::create([
            'exam_id' => $this->current,
            'code' => $this->code,
            'active' => true
        ]);

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

    public function importCourse(){
        $user = Auth::user();
        if($user->plan == "Premium"){ $this->plan_id = 2;}
        $plan = Plan::find($this->plan_id);
        $plan_limit = $plan->courses_limit;

        $current = Exam::all_items($user->id)->count();

        //if it is out of bounds
        if($plan_limit != null && $current >= $plan_limit){
            //show messagge
            session()->flash('emessage', 'You have created all the courses allowed in your plan. To create a new course you must delete one or update your plan');
        }
        else{
            return redirect()->route('import');
        } 
        
    }
    public function createNew(){
        $user = Auth::user();
        if($user->plan == "Premium"){ $this->plan_id = 2;}
        $plan = Plan::find($this->plan_id);
        $plan_limit = $plan->courses_limit;

        $current = Exam::all_items($user->id)->count();

        //if it is out of bounds
        if($plan_limit != null && $current >= $plan_limit){
            //show messagge
            session()->flash('emessage', 'You have created all the courses allowed in your plan. To create a new course you must delete one or update your plan');
        }
        else{
            return redirect()->route('newcourse');
        } 
        
    }

}
