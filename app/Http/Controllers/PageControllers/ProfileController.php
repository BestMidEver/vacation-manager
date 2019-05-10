<?php

namespace App\Http\Controllers\PageControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function page()
    {
        return view('pages.profile');
    }

    public function page2()
    {
        return view('pages.settings');
    }
}
