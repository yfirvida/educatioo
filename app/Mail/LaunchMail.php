<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LaunchMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $course;
    protected $class;
    protected $start;
    protected $end;
    protected $instructions;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($class, $course, $instructions, $start, $end)
    {
        $this->class = $class;
        $this->course = $course;
        $this->instructions = $instructions;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.launch')->with([
                        'class' => $this->class,
                        'course' => $this->course,
                        'start' => $this->start,
                        'end' => $this->end,
                        'instructions' => $this->instructions
                    ]);;
    }
}
