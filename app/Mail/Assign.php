<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Classroom;

class Assign extends Mailable
{
    use Queueable, SerializesModels;

    protected $pin;
    protected $class;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $user_id, string $class_id)
    {
        $this->user = User::find($user_id); 
        $class = Classroom::find($class_id);
        $this->class = $class->name;

        $pivot = $this->user->classrooms->find($class_id);
        $this->pin = $pivot->pivot->pin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.assign')->with([
                        'class' => $this->class,
                        'pin' => $this->pin,
                        'user' => $this->user,
                    ]);;
    }
}
