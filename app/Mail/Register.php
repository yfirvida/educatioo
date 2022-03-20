<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Plan;


class Register extends Mailable
{
    use Queueable, SerializesModels;

    protected $plan;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user; 
        $this->plan = Plan::getByName($user->plan);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.register')->with([
                        'plan' => $this->plan,
                        'user' => $this->user,
                    ]);
    }
}
