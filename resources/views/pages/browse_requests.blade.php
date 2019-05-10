@extends('layout.app')

@section('body')
<ul class="nav nav-tabs mt-4">
	<li class="nav-item">
		<a class="nav-link {{ Request::segment(2) === 'all' || Request::segment(2) == '' ? 'active' : '' }}" href="/browse-requests/all">All</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ Request::segment(2) === 'pending' ? 'active' : '' }}" href="/browse-requests/pending">Pending</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ Request::segment(2) === 'accepted' ? 'active' : '' }}" href="/browse-requests/accepted">Accepted</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ Request::segment(2) === 'declined' ? 'active' : '' }}" href="/browse-requests/declined">Declined</a>
	</li>
</ul>

<form class="mt-4" method="GET" action="/browse-requests/{{ Request::segment(2) }}">
	<div class="input-group">
		<input type="text" class="form-control" placeholder="Search with name or full email address" id="search" name="search" value="{{ request()->search }}" required>
		<div class="input-group-append">
			<button class="btn btn-outline-secondary" type="submit">Search</button>
		</div>
	</div>
</form>

<div class="mt-3 accordion" id="accordion">
	@foreach ($data as $leave)
	<div>
		<div class="d-flex py-2 align-items-center">
			<div class="flex-grow-1">
				<button class="btn btn-link pl-0 text-dark" type="button" data-toggle="collapse" data-target="#collapse{{ $leave->id }}" aria-expanded="false">{{$leave->user_name}} | {{$leave->start_date}} - {{ $leave->vacation_days }} {{ $leave->vacation_days > 1 ? 'days' : 'day' }}</button>
				<div id="collapse{{ $leave->id }}" class="collapse" data-parent="#accordion">
					<div>Created at {{ $leave->created_at }}</div>
					@if ($leave->mode === 1)
					<div>Accepted at {{ $leave->updated_at }} by {{ $leave->administrator_name }}</div>
					@elseif ($leave->mode === 2)
					<div>Declined at {{ $leave->updated_at }} by {{ $leave->administrator_name }}</div>
					@endif
					<a class="btn btn-link pl-0" href="/calendar/{{ explode('-', $leave->start_date)[0] }}/{{ explode('-', $leave->start_date)[1] }}">Show in calendar view</a>
				</div>
			</div>
			<div class="ml-2">
				<a class="btn btn-outline-success {{ $leave->mode === 1 ? 'active' : '' }}" {{ $leave->mode !== 1 ? 'href=/manipulate-request/accept/'.$leave->id : '' }}>Accept</a>
				<a class="btn btn-outline-warning {{ $leave->mode === 2 ? 'active' : '' }}" {{ $leave->mode !== 2 ? 'href=/manipulate-request/decline/'.$leave->id : '' }}>Decline</a>
				<a class="btn btn-outline-danger" href="/manipulate-request/delete/{{ $leave->id }}">Delete</a>
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