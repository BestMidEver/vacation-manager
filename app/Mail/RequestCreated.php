<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($leave_request, $employee_name)
    {
        $this->leave_request = $leave_request;
        $this->employee_name = $employee_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.request_created')
        ->with('leave_request', $this->leave_request)
        ->with('employee_name', $this->employee_name);
    }
}
