<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotificationForLeaves;
use App\Leave;
use App\Mail\RequestDeclined;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ManipulateRequest extends Controller
{
    public function new(Request $request)
    {
    	$request->validate([
    		'start_date' => 'required',
    		'vacation_days' => 'required|max:'.env('MAX_VALIDATION_DAY', 5)
    	]);

    	$leave = new Leave;
    	$leave->user_id = Auth::id();
    	$leave->mode = Auth::user()->hierarchy > 2 ? 1 : 0;
    	$leave->administrator_id = Auth::user()->hierarchy > 2 ? Auth::id() : null;
    	$leave->start_date = $request->start_date;
    	$leave->vacation_days = $request->vacation_days;
    	$leave->save();

		$request->session()->flash('success', Auth::user()->hierarchy > 2 ? 'New leave request is created and accepted by you.' : 'New leave request is created.');

        if (Auth::user()->hierarchy < 3) {
            SendNotificationForLeaves::dispatch('created', $leave);
        }

        return redirect()->back();
    }


    public function new_custom(Request $request)
    {
        $request->validate([
            'email' => 'exists:users,email',
            'start_date' => 'required',
            'vacation_days' => 'required|max:'.env('MAX_VALIDATION_DAY', 5)
        ], [
            'email.exists' => 'There is no user with '.$request->email.' email address.'
        ]);

        $user = User::where('email', '=', $request->email)->first();

        $leave = new Leave;
        $leave->user_id = $user->id;
        $leave->mode = 1;
        $leave->administrator_id = Auth::id();
        $leave->start_date = $request->start_date;
        $leave->vacation_days = $request->vacation_days;
        $leave->save();

        $request->session()->flash('success', 'New leave request is created and accepted by you.');

        SendNotificationForLeaves::dispatch('created and accepted', $leave);

        return redirect()->back();
    }


    public function accept($leave_id)
    {
    	$leave = Leave::find($leave_id);
    	$leave->mode = 1;
    	$leave->administrator_id = Auth::id();
    	$leave->save();

        SendNotificationForLeaves::dispatch('accepted', $leave);

        return redirect()->back();
    }


    public function decline($leave_id)
    {
    	$leave = Leave::find($leave_id);
    	$leave->mode = 2;
    	$leave->administrator_id = Auth::id();
    	$leave->save();

        SendNotificationForLeaves::dispatch('declined', $leave);

        return redirect()->back();
    }

    
    public function delete($leave_id)
    {
        $leave = Leave::find($leave_id);
        
        SendNotificationForLeaves::dispatch('deleted', $leave);
    	
    	$leave->delete();

        return redirect()->back();
    }
}
