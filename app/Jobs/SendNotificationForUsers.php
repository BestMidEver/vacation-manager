<?php

namespace App\Jobs;

use App\Mail\UserAdministrator;
use App\Mail\UserApproved;
use App\Mail\UserCreated;
use App\Mail\UserPending;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationForUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mode, $user_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mode, $user_id)
    {
        $this->mode = $mode;
            // user created
            // user pending
            // user approved
            // user administrator
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->user_id);

        if ($this->mode == 'created') {
            // Notifies user and all of the administrators for new user
            $administrators = User::where('hierarchy', '>', 2)
            ->where('notification', '=', 1)
            ->get();

            foreach ($administrators as $administrator) {
                Mail::to($administrator)->send(new UserCreated($user));
            }

        } else {
            // Notifies user for the change in hierarchy
            if ($user->notification == 0) return;
            
            if ($this->mode == 'pending') {
                Mail::to($user)->send(new UserPending($user));
            }

            else if ($this->mode == 'approved') {
                Mail::to($user)->send(new UserApproved($user));
            }

            else if ($this->mode == 'administrator') {
                Mail::to($user)->send(new UserAdministrator($user));
            }

        }
    }
}
