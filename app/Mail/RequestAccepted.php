<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestAccepted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($leave_request, $administrator_name)
    {
        $this->leave_request = $leave_request;
        $this->administrator_name = $administrator_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.request_accepted')
        ->with('leave_request', $this->leave_request)
        ->with('administrator_name', $this->administrator_name);
    }
}
