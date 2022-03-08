<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classroom;

use Illuminate\Support\Facades\Hash;

class Classrooms extends Component
{
    public $name, $level_id, $namestd, $email;
    public $levels, $students, $extras, $assignST;
    public $trainer_id, $classroom_id, $st_id, $current;

    protected $rules = [
        'students.*.pin' => 'required|string|min:6',
        'assignST.*.pin' => 'required|string|min:6',
    ];

    public function render()
    {
        $user = Auth::user();
        $this->trainer_id = $user->id;
        $classrooms = Classroom::where('trainer_id', $this->trainer_id)->paginate(15);
        return view('livewire.trainer.classrooms', ['classrooms' => $classrooms])->layout('layouts.main');
    }
    private function resetInputFields() {
        
        $this->name = '';
        $this->level_id  = null;
        $this->students = [];
        $this->current = false;

    }
    public function showForm() {
        $user = Auth::user();
        self::resetInputFields();
        $this->resetErrorBag();
        $this->levels = Level::all_items();
        $this->students = User::allStudents($this->trainer_id);
        foreach($this->students as $index => $student){
            $this->students[$index]->pin = bin2hex(random_bytes(4));
        }
        $this->dispatchBrowserEvent('openModal');
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
    
        for ($x = 0; $x < $length = count($this->students); $x++) {
            if($this->students[$x]->pin != null){
               $classroom->users()->attach($this->students[$x]->id, ['pin' => $this->students[$x]->pin]); 
            }
            
        }
        
        self::resetInputFields();
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
        $this->dispatchBrowserEvent('openUpdateModal');
        
    }

    public function removeFromClass($index)
    {
        $classroom = Classroom::find($this->classroom_id);
        $classroom->users()->detach($this->students[$index]->id); 
        unset($this->students[$index]);

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

            //asign students
    
            for ($x = 0; $x < $length = count($this->students); $x++) {
                if($this->students[$x]->pin != null){
                   $classroom->users()->updateExistingPivot($this->students[$x]->id, ['pin' => $this->students[$x]->pin]); 
                }
                
            }


            $this->updateMode = false;
            session()->flash('message', 'Course Group Updated Successfully.');
            $this->resetInputFields();
            $this->dispatchBrowserEvent('closeUpdateModal');


        }
    }

    public function delete($id)
    {
        if($id){
            $classroom = Classroom::find($id);
            $classroom->users()->detach();
            Classroom::where('id',$id)->delete();
            session()->flash('message', 'Plan Deleted Successfully.');
        }
    }
    public function removeSt($index)
    {
        unset($this->students[$index]);

    }

    public function removeASt($index, $id)
    {
        
        $this->current->users()->detach($id);
        $this->extras = User::allStudentsOutThisClassroom($this->trainer_id , $this->current->id);
        $this->assignST = $this->current->users()->get();
        foreach($this->assignST as $index => $student){
            $this->assignST[$index]->pin = $this->assignST[$index]->pivot->pin;
        }

    }

    private function resetInputFieldsSt() {
        
        $this->name = '';
        $this->email  = '';
    }

    public function showStForm() {
        $user = Auth::user();

        self::resetInputFieldsSt();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openStdModal');
    }
    public function closeStd()
    {

        $this->dispatchBrowserEvent('closeStdModal'); 

    }

    public function storeStudent()
    {

        $validatedData = $this->validate([
            'namestd' => 'required',
            'email' => 'required',
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
            $this->assignST = $this->current->users()->get();
            foreach($this->assignST as $index => $student){
                $this->assignST[$index]->pin = $this->assignST[$index]->pivot->pin;
            }
        } 
        else{
            $this->students = User::allStudents($this->trainer_id);
            foreach($this->students as $index => $student){
                $this->students[$index]->pin = bin2hex(random_bytes(4));
            }
        }
        $this->dispatchBrowserEvent('closeStdModal'); // Close modal using jquery

    }

    public function showAssignForm($class) {
        $this->extras = User::allStudentsOutThisClassroom($this->trainer_id , $class);

        $this->current = Classroom::where('id',$class)->first();
        $this->name = $this->current->name;
        $this->assignST = $this->current->users()->get();
        foreach($this->assignST as $index => $student){
            $this->assignST[$index]->pin = $student->pivot->pin;
        }
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openAssignModal');
    }

    public function assign(){

        $pin = bin2hex(random_bytes(4));
        $this->current->users()->attach($this->st_id, ['pin' => $pin]); 

        $this->assignST = $this->current->users()->get();
        foreach($this->assignST as $index => $student){
            $this->assignST[$index]->pin = $this->assignST[$index]->pivot->pin;
        }

    }
    
    
}
