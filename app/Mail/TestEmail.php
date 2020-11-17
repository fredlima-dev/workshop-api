<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


    public function build()
    {
        $this->subject( 'Recuperação de senha');
        $this->to($this->user->email, $this->user->name);
        return $this->view('emails.test',[
            'data'=> $this->user
        ]);
    }
}
