@extends('layout.app')

@section('body')
<ul class="nav nav-tabs mt-4">
	<li class="nav-item">
		<a class="nav-link {{ Request::segment(2) === 'all' || Request::segment(2) == '' ? 'active' : '' }}" href="/browse-users/all">All</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ Request::segment(2) === 'pending-employee' ? 'active' : '' }}" href="/browse-users/pending-employee">Pending employee</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ Request::segment(2) === 'employee' ? 'active' : '' }}" href="/browse-users/employee">Employee</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ Request::segment(2) === 'administrator' ? 'active' : '' }}" href="/browse-users/administrator">Administrator</a>
	</li>
</ul>
<div class="mt-3 accordion" id="accordion">
	@foreach ($data as $user)
	<div>
		<div class="d-flex py-2 align-items-center">
			<div class="flex-grow-1">
				<button class="btn btn-link pl-0 text-dark" type="button" data-toggle="collapse" data-target="#collapse{{$user->user_id}}" aria-expanded="false">{{$user->user_name}}</button>
				<div id="collapse{{ $user->user_id }}" class="collapse" data-parent="#accordion">
					<div>Created at {{ $user->created_at }}</div>
					<div>Email <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
					<div><a href="/custom-leave/{{ $user->email }}">Create a new leave for this user</a></div>
				</div>
			</div>
			<div class="ml-2">
				<a class="btn btn-outline-secondary {{ $user->hierarchy === 0 ? 'active' : '' }}" {{ $user->hierarchy !== 0 ? 'href=/manipulate-user/pending-employee/'.$user->user_id : '' }}>Pending employee</a>
				<a class="btn btn-outline-success {{ $user->hierarchy === 1 ? 'active' : '' }}" {{ $user->hierarchy !== 1 ? 'href=/manipulate-user/employee/'.$user->user_id : '' }}>Employee</a>
				<a class="btn btn-outline-info {{ $user->hierarchy > 2 ? 'active' : '' }}" {{ $user->hierarchy < 3 ? 'href=/manipulate-user/administrator/'.$user->user_id : '' }}>Administrator</a>
			</div>
		</div>
		<hr class="m-0">
	</div>
	@endforeach
	@if ($data->count() === 0)
	<div class="d-flex py-5 align-items-center justify-content-center text-muted">Nothing found.</div>
	@endif
</div>
@include('include.paginate')
@endsection