<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;

use Mail;
use App\Mail\LaunchMail;


class Launch extends Component
{

    public $course_id, $classroom_id, $groups,  $certificate_id, $min_points, $students, $certificates, $instructions, $start, $end; 
    public $current_course, $current_group, $current_s, $update_mode = false;
    public $utc_start, $utc_end;
    public $quiz, $today;
    protected $launch;

    public function mount()
    {
        $user = Auth::user();
        $this->certificates = Certificate::all();
        $this->groups = Classroom::all_items($user->id);
        $this->quiz = Exam::all_items2($user->id);
    }

    public function render()
    {
        if($this->classroom_id && !$this->update_mode)
        {
            $classroom = Classroom::find($this->classroom_id);
            $this->students = $classroom->users()->get();
        }

        $user = Auth::user();
        $this->launch = Exam::activeExams($user->id);

        $this->today = new DateTime();
        $this->today->setTimeZone(new DateTimeZone('UTC'));
        $this->today = $this->today->format('Y-m-d H:i:s');
        return view('livewire.trainer.launch', ['launchs' => $this->launch])->layout('layouts.main');
    }

    private function resetInputFields() {
        
        $this->course_id = null;
        $this->classroom_id  = null;
        $this->certificate_id  = null;
        $this->instructions = null;
        $this->start = null;
        $this->end  = null;
        $this->min_points  = null;
        $this->total_points  = null;
    }
    public function showForm() {
        
        self::resetInputFields();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('openModal');
    }
    public function close()
    {
        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('closeEditModal');

    }

    public function selectGroup($value)
    {
        $classroom = Classroom::find($value);
        $this->students = $classroom->users()->get();
    }

    public function store()
    {

        $validatedData = $this->validate([
            'course_id' => 'required',
            'classroom_id' => 'required',
            'certificate_id' => 'required',
            'instructions' => 'required',
            'start' => 'required',
            'end' => 'required',
            'utc_start' => 'required',
            'utc_end' => 'required',
            'min_points' => 'required',
            'total_points' => 'required',
        ]);

        //format the dates
        $start = DateTime::createFromFormat('d/m/Y g:i A', $this->start)->format('Y-m-d H:i:s');
        $utc_start = DateTime::createFromFormat('D, d M Y H:i:s e', $this->utc_start)->format('Y-m-d H:i:s'); 


        $end = DateTime::createFromFormat('d/m/Y g:i A', $this->end)->format('Y-m-d H:i:s');
        $utc_end = DateTime::createFromFormat('D, d M Y H:i:s e', $this->utc_end)->format('Y-m-d H:i:s'); 

        

        //launch
        $classroom = Classroom::find($this->classroom_id);
        $classroom->exams()->attach($this->course_id, ['start' => $start, 'end' => $end, 'utc_start' => $utc_start, 'utc_end' => $utc_end, 'min_points' => $this->min_points, 'total_points' => $this->total_points, 'email_instructions' => $this->instructions, 'certificate_id' => $this->certificate_id]);

        //get course name for email

        $course = Exam::find($this->course_id);

        //send mail
        $users = $classroom->users;
        foreach($users as $user){
            Mail::to($user)->send(new LaunchMail($classroom->name, $course->name, $this->instructions, $this->start, $this->end));
        }
        
        
        $this->dispatchBrowserEvent('closeModal'); // Close modal using jquery

    }

    public function confirm($class, $course, $s)
    {
        $this->current_course = $course; 
        $this->current_group = $class;
        $this->current_s = $s;
        $this->dispatchBrowserEvent('openconfirmModal');

    }

     public function closeconfirm()
    {

        $this->dispatchBrowserEvent('closeconfirmModal'); 

    }
    public function endnow($course, $class, $s, $date)
    {
        $c = Exam::find($course);

        $today = new DateTime();
        $utc = $today->setTimeZone(new DateTimeZone('UTC'));
        $utc = $utc->format('Y-m-d H:i:s');

        $d = new DateTime($date);
        $d = $d->format('Y-m-d H:i:s');
        

        $c->classrooms()->wherePivot('start', $s)->updateExistingPivot($class, ['end' => $d, 'utc_end' => $utc]); 

        session()->flash('message', 'Course Ended Successfully. To access the this Course go to Results');
       
        $this->current_course = null; 
        $this->current_group = null;

        $this->dispatchBrowserEvent('closeconfirmModal'); 

    }

    public function edit($class, $course, $s) 
    {
        $this->update_mode = true;
        $this->course_id = $course; 
        $this->classroom_id = $class;

        $classroom = Classroom::find($this->classroom_id);

        $relation = $classroom->exams()->where('exam_id',$this->course_id )->where('start',$s )->first();


        //format the dates
        $this->start = DateTime::createFromFormat('Y-m-d H:i:s', $relation->pivot->start)->format('d/m/Y g:i A');
        $this->end = DateTime::createFromFormat('Y-m-d H:i:s', $relation->pivot->end)->format('d/m/Y g:i A');

        $this->utc_start = DateTime::createFromFormat('Y-m-d H:i:s', $relation->pivot->utc_start)->format('D, d M Y H:i:s e'); 
        $this->utc_end = DateTime::createFromFormat('Y-m-d H:i:s', $relation->pivot->utc_end)->format('D, d M Y H:i:s e');


        $this->certificate_id = $relation->pivot->certificate_id;
        $this->min_points = $relation->pivot->min_points;
        $this->total_points = $relation->pivot->total_points;

        $this->dispatchBrowserEvent('openEditModal');
        
    }

    public function update(){

        $classroom = Classroom::find($this->classroom_id);

        //format the dates
        $start = DateTime::createFromFormat('d/m/Y g:i A', $this->start)->format('Y-m-d H:i:s');
        $utc_start = DateTime::createFromFormat('D, d M Y H:i:s e', $this->utc_start)->format('Y-m-d H:i:s'); 


        $end = DateTime::createFromFormat('d/m/Y g:i A', $this->end)->format('Y-m-d H:i:s');
        $utc_end = DateTime::createFromFormat('D, d M Y H:i:s e', $this->utc_end)->format('Y-m-d H:i:s'); 


        $classroom->exams()->updateExistingPivot($this->course_id, ['start' => $start, 'end' => $end, 'utc_start' => $utc_start, 'utc_end' => $utc_end,'min_points' => $this->min_points, 'total_points' => $this->total_points, 'certificate_id' => $this->certificate_id]);

        $this->update_mode = false;
        $this->dispatchBrowserEvent('closeEditModal');

    }
}
