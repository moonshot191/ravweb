<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email_address)
    {
        $this->name = $name;
        $this->email = $email_address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.name');
    }
}