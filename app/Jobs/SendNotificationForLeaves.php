<?php

namespace App\Jobs;

use App\Leave;
use App\Mail\RequestAccepted;
use App\Mail\RequestCreated;
use App\Mail\RequestCreatedAndAccepted;
use App\Mail\RequestDeclined;
use App\Mail\RequestDeleted;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationForLeaves implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mode, $leave;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mode, $leave)
    {
        $this->mode = $mode;
            // created
            // created and accepted
            // accepted
            // declined
            // deleted
        $this->leave = $leave;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $leave_request = $this->leave;
        $employee = User::find($leave_request->user_id);

        if ($this->mode == 'created') {
            // Notifies all administrators for new leave request
            $administrators = User::where('hierarchy', '>', 2)
            ->where('notification', '=', 1)
            ->get();

            foreach ($administrators as $administrator) {
                Mail::to($administrator)->send(new RequestCreated($leave_request, $employee->name));
            }

        } else {
            // Notifies user for the decision of leave request
            if ($employee->notification == 0) return;

            $administrator_name = User::find($leave_request->administrator_id)->name;

            if ($this->mode == 'accepted') {
                Mail::to($employee)->send(new RequestAccepted($leave_request, $administrator_name));
            }

            else if ($this->mode == 'declined') {
                Mail::to($employee)->send(new RequestDeclined($leave_request, $administrator_name));
            }

            else if ($this->mode == 'deleted') {
                Mail::to($employee)->send(new RequestDeleted($leave_request, $administrator_name));
            }
        }
    }
}
