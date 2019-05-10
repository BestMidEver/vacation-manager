<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewLeaveController extends Controller
{
    public function page()
    {
        return view('pages.add_leave');
    }

    public function page2($email = '')
    {
        return view('pages.add_custom_leave')
        ->with('email', $email);
    }
}
