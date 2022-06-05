<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Plan;

use Illuminate\Support\Facades\Hash;

use Mail;
use App\Mail\Assign;

class Classrooms extends Component
{
    public $name, $level_id, $namestd, $email, $sendMailError;
    public $levels, $students, $extras, $assignST;
    public $trainer_id, $classroom_id, $st_id, $current, $current_class;
    protected $plan_id = 1;

    protected $rules = [
        'students.*.pin' => 'required|string|min:6|unique',
        'assignST.*.pin' => 'required|string|min:6|unique',
    ];

    public function render()
    {
        $user = Auth::user();
        
        $this->trainer_id = $user->id;
        $classrooms = Classroom::where('trainer_id', $this->trainer_id)->paginate(10);
        return view('livewire.trainer.classrooms', ['classrooms' => $classrooms])->layout('layouts.main');
    }
    private function resetInputFields() {
        
        $this->name = '';
        $this->level_id  = null;
        $this->current = false;

    }
    public function showForm() {

        $user = Auth::user();
        if($user->plan == "Premium"){ $this->plan_id = 2;}
        $plan = Plan::find($this->plan_id);
        $plan_limit = $plan->groups_limit;

        $current = Classroom::where('trainer_id', $this->trainer_id)->count();

        //if it is out of bounds
        if($plan_limit != null && $current >= $plan_limit){
            //show messagge
            session()->flash('emessage', 'You have created all the groups allowed in your plan. To create a new group you must delete one or update your plan');
        }
        else{
            self::resetInputFields();
            $this->resetErrorBag();
            $this->levels = Level::all_items();
    
            \Session::put('students', []);
            $this->dispatchBrowserEvent('openModal');
        } 
        
    }
    public function close()
    {

        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeUpdateModal');


    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required | unique:classrooms',
            'level_id' => 'required',
        ]);

        $classroom = Classroom::create(['name' => $this->name,
            'email' => $this->email,
            'level_id' => $this->level_id,
            'trainer_id' => $this->trainer_id
        ]);

        //asign students


    /*if($this->students != null){
        for ($x = 0; $x < $length = count($this->students); $x++) {
            if($this->students[$x]->pin != null){
               $classroom->users()->attach($this->students[$x]->id, ['pin' => $this->students[$x]->pin]); 

                   //send mail
                    $user = User::find($this->students[$x]->id);
                    Mail::to($user)->send(new Assign($this->students[$x]->id, $classroom->id));
            }
            
        }
    }*/
        
        
       // self::resetInputFields();
        $this->dispatchBrowserEvent('closeModal'); // Close modal using jquery


    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->classroom_id = $id;
        $classroom = Classroom::where('id',$id)->first();
        $this->name = $classroom->name;
        $this->level_id = $classroom->level_id;
        $this->levels = Level::all_items();
        $this->students = $classroom->users()->get();
        foreach($this->students as $index => $student){
            $this->students[$index]->pin = $this->students[$index]->pivot->pin;
        }
        \Session::put('students', $this->students->toArray());
        $this->dispatchBrowserEvent('openUpdateModal');
        
    }

    public function removeFromClass($index)
    {
        $classroom = Classroom::find($this->classroom_id);
        $classroom->users()->detach($this->students[$index]->id); 
        unset($this->students[$index]);
        \Session::put('students', $this->students->toArray());

    }


    public function update()
    {
        if ($this->classroom_id) {
            $classroom = Classroom::find($this->classroom_id);
            //'name' => 'required | unique:classrooms,'.$this->classroom_id,
            $validatedData = $this->validate([
                'name' => 'required',
                'level_id' => 'required'
            ]);

        
            $classroom->update([
                'name' => $this->name,
                'level_id' => $this->level_id
            ]);

            \Session::put('students', $this->students->toArray());
            $this->updateMode = false;
            session()->flash('message', 'Course Group Updated Successfully.');
            $this->resetInputFields();
            $this->dispatchBrowserEvent('closeUpdateModal');


        }
    }

    //delete
    public function confirm($id)
    {
        $this->current_class = $id;
        $this->dispatchBrowserEvent('openConfirmModal');

    }

     public function closeConfirm()
    {

        $this->dispatchBrowserEvent('closeConfirmModal'); 

    }

    public function delete($id)
    {
        if($id){
            $classroom = Classroom::find($id);
            $classroom->users()->detach();
            $classroom->exams()->detach();
            Classroom::where('id',$id)->delete();
            session()->flash('message', 'Group Deleted Successfully.');
            $this->dispatchBrowserEvent('closeConfirmModal'); 
            \Session::put('students', null);
        }
    }
    public function removeSt($index)
    {
        unset($this->students[$index]);
        \Session::put('students', $this->students->toArray());

    }

    public function removeASt($index, $id)
    {
        
        $this->current->users()->detach($id);
        $this->extras = User::allStudentsOutThisClassroom($this->trainer_id , $this->current->id);
        $this->assignST = $this->current->users()->get();
       /* foreach($this->assignST as $index => $student){
            $this->assignST[$index]->pin = $this->assignST[$index]->pivot->pin;
        }*/

        \Session::put('students', $this->assignST->toArray());

    }

    public function deleteAll()
    {
        
        $this->students = null; 
        \Session::put('students', []);

    }

    private function resetInputFieldsSt() {
        
        $this->namestd = '';
        $this->email  = '';
    }

    public function showStForm() {

        $user = Auth::user();
        if($user->plan == "Premium"){ $this->plan_id = 2;}
        $plan = Plan::find($this->plan_id);
        $plan_limit = $plan->students_limit;

        $current = $this->students->count();

        //if it is out of bounds
        if($plan_limit != null && $current >= $plan_limit){
            //show messagge
            session()->flash('smessage', 'You have created all the students allowed in your plan. To create a new student you must delete one or update your plan');
        }
        else{
            self::resetInputFieldsSt();
            $this->resetErrorBag();
            $this->dispatchBrowserEvent('openStdModal');
        } 

        
    }
    public function closeStd()
    {

        $this->dispatchBrowserEvent('closeStdModal'); 

    }

    public function storeStudent()
    {

        $validatedData = $this->validate([
            'namestd' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $st = User::create(['name' => $this->namestd,
            'email' => $this->email,
            'password' => Hash::make('1234'),
            'role' => 'student',
            'trainer_id' => $this->trainer_id
        ]);

        self::resetInputFieldsSt();

        if($this->current){
            $pin = bin2hex(random_bytes(4));
            $this->current->users()->attach($st->id, ['pin' => $pin]);
            $this->extras = User::allStudentsOutThisClassroom($this->trainer_id , $this->current->id);
            $this->assignST = User::hydrate(\Session::get('students'));
            $this->assignST->push($st);
           /* foreach($this->assignST as $index => $student){
                $this->assignST[$index]->pin = $this->assignST[$index]->pivot->pin;
            }*/
            \Session::put('students', $this->assignST->toArray());

            //send mail
            Mail::to($st)->send(new Assign($st->id, $this->current->id));
        } 
        else{ 
            //$this->students = User::allStudents($this->trainer_id);
            $this->students = User::hydrate(\Session::get('students'));
            $this->students->push($st);
            foreach($this->students as $index => $student){
                $this->students[$index]->pin = bin2hex(random_bytes(4));
            }

            $st->classrooms()->attach($this->classroom_id, ['pin' => $st->pin]);
            //send mail
            Mail::to($st)->send(new Assign($st->id, $this->classroom_id)); 
            \Session::put('students', $this->students->toArray());
        }
        $this->dispatchBrowserEvent('closeStdModal'); // Close modal using jquery

    }

    public function showAssignForm($class) {

        $user = Auth::user();
        if($user->plan == "Premium"){ $this->plan_id = 2;}
        $plan = Plan::find($this->plan_id);
        $plan_limit = $plan->students_limit;

        $this->current = Classroom::where('id',$class)->first();
        $current = $this->current->users()->count();

        //if it is out of bounds
        if($plan_limit != null && $current >= $plan_limit){
            //show messagge
            session()->flash('emessage', 'You have assigned all the students allowed in your plan. To assign a new student you must delete one or update your plan');
        }
        else{
            $this->extras = User::allStudentsOutThisClassroom($this->trainer_id , $class);

            $this->current = Classroom::where('id',$class)->first();
            $this->name = $this->current->name;
            $this->assignST = $this->current->users()->get();
            foreach($this->assignST as $index => $student){
                $this->assignST[$index]->pin = $student->pivot->pin;
            }
            \Session::put('students', $this->assignST->toArray());
            $this->resetErrorBag();
            $this->dispatchBrowserEvent('openAssignModal');
        } 
        
    }

    public function assign(){

        $pin = bin2hex(random_bytes(4));
        $this->current->users()->attach($this->st_id, ['pin' => $pin]); 

        //send mail
        $user = User::find($this->st_id);
        Mail::to($user)->send(new Assign($this->st_id, $this->current->id));

        $this->assignST = $this->current->users()->get();
        foreach($this->assignST as $index => $student){
            $this->assignST[$index]->pin = $this->assignST[$index]->pivot->pin;
        }
        \Session::put('students', $this->assignST->toArray());

    }
    
    
}
