@extends('layout.app')

@section('body')
<div class="jumbotron mt-4">
	<h1 class="display-4">Vacation Manegement Project</h1>
	<p class="lead">This is a simple web application using PHP, Laravel, MySQL and Docker Compose.</p>
	<hr class="my-4">
	@if (Auth::check())
		@if (Auth::user()->hierarchy === 0)
	<p>Welcome {{Auth::user()->name}}. Your account is pending. An administrator has to approve your registration first.</p>
		@elseIf (Auth::user()->hierarchy === 1)
	<p>Welcome {{Auth::user()->name}}. Your account is an approved employee account. </p>
		@elseIf (Auth::user()->hierarchy === 2)
	<p>Welcome {{Auth::user()->name}}. An administrator have to approve your administrator claim.</p>
		@elseIf (Auth::user()->hierarchy === 3)
	<p>Welcome {{Auth::user()->name}}. Your account is an administrator account.</p>
		@elseIf (Auth::user()->hierarchy === 4)
	<p>Welcome {{Auth::user()->name}}. Your account is the architect account.</p>
		@endif
	@else
	<p>Please login with your Google Account in order to use it.</p>
	<a class="btn btn-primary btn-lg" href="/login" role="button">Log in</a>
	@endif
</div>
@endsection