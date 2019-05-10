@extends('layout.app')

@section('body')
<ul class="nav nav-tabs mt-4">
	<li class="nav-item">
		<a class="nav-link" href="/profile">Profile</a>
	</li>
	<li class="nav-item">
		<a class="nav-link active">Settings</a>
	</li>
</ul>

<div class="mt-3 accordion">
	<div>
		<div class="d-flex py-2 align-items-center">
			<div class="flex-grow-1">
				<p class="card-text">Email notification</p>
			</div>
			<div class="ml-2">
				<a class="btn btn-outline-secondary {{ Auth::user()->notification === 0 ? 'active' : '' }}" {{ Auth::user()->notification === 1 ? 'href=/manipulate-user/disabled/' : '' }}>Disabled</a>
				<a class="btn btn-outline-success {{ Auth::user()->notification === 1 ? 'active' : '' }}" {{ Auth::user()->notification === 0 ? 'href=/manipulate-user/enabled/' : '' }}>Enabled</a>
			</div>
		</div>
		<hr class="m-0">
	</div>
	<div>
		<div class="d-flex py-2 align-items-center">
			<div class="flex-grow-1">
				<p class="card-text">Quick change your hierarchy for testing purpose</p>
			</div>
			<div class="ml-2">
				<a class="btn btn-outline-secondary {{ Auth::user()->hierarchy === 0 ? 'active' : '' }}" {{ Auth::user()->hierarchy !== 0 ? 'href=/change-hierarchy-for-testing-purpose/0' : '' }}>Pending Employee</a>
				<a class="btn btn-outline-success {{ Auth::user()->hierarchy === 1 ? 'active' : '' }}" {{ Auth::user()->hierarchy !== 1 ? 'href=/change-hierarchy-for-testing-purpose/1' : '' }}>Employee</a>
				<a class="btn btn-outline-info {{ Auth::user()->hierarchy === 3 ? 'active' : '' }}" {{ Auth::user()->hierarchy !== 3 ? 'href=/change-hierarchy-for-testing-purpose/3' : '' }}>Administrator</a>
				<a class="btn btn-outline-dark {{ Auth::user()->hierarchy === 4 ? 'active' : '' }}" {{ Auth::user()->hierarchy !== 4 ? 'href=/change-hierarchy-for-testing-purpose/4' : '' }}>Architect</a>
			</div>
		</div>
		<hr class="m-0">
	</div>
</div>
@endsection