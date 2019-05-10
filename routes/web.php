<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'pages.home');



Route::get('/login', [ 'as' => 'login', 'uses' => 'PageControllers\LoginController@redirectToProvider' ])->middleware('guest');

Route::get('/oauth2callback', 'PageControllers\LoginController@handleProviderCallback');

Route::get('/logout', 'PageControllers\LoginController@logout')->middleware('auth');



Route::get('/calendar/{year?}/{month?}/{navigate?}', 'PageControllers\CalendarController@page')->middleware('navigateCalendar');

Route::get('/new-leave', 'PageControllers\NewLeaveController@page')->middleware('auth', 'minimumEmployee');

Route::get('/custom-leave/{email?}', 'PageControllers\NewLeaveController@page2')->middleware('auth', 'minimumAdministrator');

Route::get('/profile', 'PageControllers\ProfileController@page')->middleware('auth');

Route::get('/settings', 'PageControllers\ProfileController@page2')->middleware('auth');

Route::get('/browse-requests/{tab?}', 'PageControllers\BrowseRequestsController@page')->middleware('auth', 'minimumAdministrator');

Route::get('/browse-users/{tab?}', 'PageControllers\BrowseUsersController@page')->middleware('auth', 'minimumAdministrator');



Route::post('/manipulate-request/new', 'ApiControllers\ManipulateRequest@new')->middleware('auth', 'minimumEmployee');

Route::post('/manipulate-request/new-custom', 'ApiControllers\ManipulateRequest@new_custom')->middleware('auth', 'minimumAdministrator');

Route::get('/manipulate-request/accept/{leave_id}', 'ApiControllers\ManipulateRequest@accept')->middleware('auth', 'minimumAdministrator');

Route::get('/manipulate-request/decline/{leave_id}', 'ApiControllers\ManipulateRequest@decline')->middleware('auth', 'minimumAdministrator');

Route::get('/manipulate-request/delete/{leave_id}', 'ApiControllers\ManipulateRequest@delete')->middleware('auth', 'minimumAdministrator');


Route::get('/manipulate-user/pending-employee/{user_id}', 'ApiControllers\ManipulateUser@pending_employee')->middleware('auth', 'minimumAdministrator');

Route::get('/manipulate-user/employee/{user_id}', 'ApiControllers\ManipulateUser@employee')->middleware('auth', 'minimumAdministrator');

Route::get('/manipulate-user/administrator/{user_id}', 'ApiControllers\ManipulateUser@administrator')->middleware('auth', 'minimumAdministrator');

Route::get('/manipulate-user/{email_setting}', 'ApiControllers\ManipulateUser@email_notification')->middleware('auth');

Route::get('/change-hierarchy-for-testing-purpose/{hierarchy}', 'ApiControllers\ManipulateUser@change_hierarchy_for_testing_purpose')->middleware('auth');


