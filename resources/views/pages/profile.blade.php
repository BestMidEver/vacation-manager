@extends('layout.app')

@section('body')
<ul class="nav nav-tabs mt-4">
	<li class="nav-item">
		<a class="nav-link active">Profile</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/settings">Settings</a>
	</li>
</ul>

<div class="mt-3">
	<p>Name: {{ Auth::user()->name }}</p>
	<p>Email: {{ Auth::user()->email }}</p>
	<p>Account type: {{ Auth::user()->hierarchy == 0 ? 'Pending employee' : (Auth::user()->hierarchy == 1 ? 'Employee' : (Auth::user()->hierarchy == 3 ? 'Administrator': (Auth::user()->hierarchy == 4 ? 'Architect' : ''))) }}</p>
	<p>Created at: {{ Auth::user()->created_at }}</p>
</div>
@endsection