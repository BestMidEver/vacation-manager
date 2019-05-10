<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotificationForUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManipulateUser extends Controller
{
    public function pending_employee($user_id)
    {
    	$user = User::find($user_id);
    	$user->hierarchy = 0;
    	$user->administrator_id = Auth::id();
    	$user->save();

        SendNotificationForUsers::dispatch('pending', $user->id);

        return redirect()->back();
    }


    public function employee($user_id)
    {
    	$user = User::find($user_id);
    	$user->hierarchy = 1;
    	$user->administrator_id = Auth::id();
    	$user->save();

        SendNotificationForUsers::dispatch('approved', $user->id);

        return redirect()->back();
    }

    
    public function administrator($user_id)
    {
    	$user = User::find($user_id);
    	$user->hierarchy = 3;
    	$user->administrator_id = Auth::id();
    	$user->save();

        SendNotificationForUsers::dispatch('administrator', $user->id);

        return redirect()->back();
    }

    
    public function email_notification($email_setting)
    {
        $user = Auth::user();
        $user->notification = $email_setting == 'enabled' ? 1 : 0;
        $user->save();

        return redirect()->back();
    }

    
    public function change_hierarchy_for_testing_purpose($hierarchy)
    {
        $user = Auth::user();
        $user->hierarchy = $hierarchy;
        $user->administrator_id = Auth::id();
        $user->save();

        return redirect()->back();
    }
}
