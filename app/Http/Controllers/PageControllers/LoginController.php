<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotificationForUsers;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Socialite;

class LoginController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $return_to = session()->has('links') ? session('links') : '/';
        Session::forget('links');

        $user = Socialite::driver('google')->user();

        $updated_user = User::updateOrCreate(
            ['id' => $user->id],
            ['name' => $user->name,
            'email' => $user->email]
        );

        if ($updated_user->wasRecentlyCreated) {
            SendNotificationForUsers::dispatch('created', $updated_user->id);
        }


        Auth::login($updated_user, true);

        return redirect($return_to);
    }

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
