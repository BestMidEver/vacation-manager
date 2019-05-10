@extends('layout.app')

@section('body')
<div class="d-flex justify-content-between my-4">
	<div><a role="button" class="btn btn-outline-secondary" href="{{ Request::url() }}/previous-year">Previous</a></div>
	<h2>{{ $time->format('Y') }}</h2>
	<div><a role="button" class="btn btn-outline-secondary" href="{{ Request::url() }}/next-year">Next</a></div>
</div>

<div class="d-flex justify-content-between my-4">
	<div><a role="button" class="btn btn-outline-secondary" href="{{ Request::url() }}/previous-month">Previous</a></div>
	<h2>{{ $time->format('F') }}</h2>
	<div><a role="button" class="btn btn-outline-secondary" href="{{ Request::url() }}/next-month">Next</a></div>
</div>

<div class="card-group text-center">
	@foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
	<div class="card border-0">
		<div class="card-body">
			<h6 class="card-title">{{ $day }}</h6>
		</div>
	</div>
	@endforeach
</div>

@foreach ($requests_array as $key=>$day)
@if ($key % 7 === 0)
<div class="card-group">
@endif
	<div class="card rounded-0">
		<div class="card-body {{ $day->month != $time->format('n') ? 'bg-light' : 'bg-white' }}" id="accordion-{{ $key }}">
			<h6 class="card-title {{ $day->month != $time->format('n') ? 'text-muted' : 'text-primary' }}">{{ $day->day }}</h6>
			@foreach ($day->requests as $request)
	        @if (Auth::check())
	        @if(Auth::user()->hierarchy > 2)
			<div>
				<button class="btn btn-link pl-0 text-{{ $request->mode == 0 ? 'secondary' : ($request->mode == 1 ? 'success' : 'warning') }}" type="button" data-toggle="collapse" data-target="#collapse-{{ $key }}-{{ $request->id }}" aria-expanded="false">{{ $request->user_name }}</button>
				<div id="collapse-{{ $key }}-{{ $request->id }}" class="collapse" data-parent="#accordion-{{ $key }}">
					<a class="btn btn-block btn-outline-success {{ $request->mode === 1 ? 'active' : '' }}" {{$request->mode !== 1 ? 'href=/manipulate-request/accept/'.$request->id : ''}}>Accept</a>
					<a class="btn btn-block btn-outline-warning {{ $request->mode === 2 ? 'active' : '' }}" {{$request->mode !== 2 ? 'href=/manipulate-request/decline/'.$request->id : ''}}>Decline</a>
					<a class="btn btn-block btn-outline-danger" href="/manipulate-request/delete/{{ $request->id }}">Delete</a>
				</div>
			</div>
			@else
			<p class="card-text text-{{ $request->mode == 0 ? 'secondary' : ($request->mode == 1 ? 'success' : 'warning') }}">{{ $request->user_name }}</p>
			@endif
			@else
			<p class="card-text text-{{ $request->mode == 0 ? 'secondary' : ($request->mode == 1 ? 'success' : 'warning') }}">{{ $request->user_name }}</p>
			@endif
			@endforeach
		</div>
	</div>
@if ($key % 7 === 6)
</div>
@endif
@endforeach
@endsection