<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $message_to_send = "";
    public $first_name_to_send = "";

    public function __construct($message, $first_name)
    {
        $this->message_to_send = $message;
        $this->first_name_to_send = $first_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contactmessageemail');//COMPACT METHOD DID SHOWS THE ERROR!
    }
}
