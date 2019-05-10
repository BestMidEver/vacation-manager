@extends('layout.app')

@section('body')
<h5 class="mt-4">Add a new leave</h5>

@if (Auth::user()->hierarchy > 2)
<ul class="nav nav-tabs mt-4">
	<li class="nav-item">
		<a class="nav-link active">For myself</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/custom-leave">For someone else</a>
	</li>
</ul>
@endif

<form class="was-validated jumbotron mt-4" method="POST" action="/manipulate-request/new">
	{{ csrf_field() }}

	<div class="form-group row mt-5">
		<label for="start-date" class="col-2 col-form-label">Start Date</label>
		<div class="col-10">
			<input class="form-control" type="date" id="start-date" name="start_date" required>
		</div>
	</div>

	<div class="form-group row">
		<label for="vacation-days" class="col-2 col-form-label">Vacation Days</label>
		<div class="col-10">
			<input class="form-control" type="number" id="vacation-days" name="vacation_days" min="1" max="{{env('MAX_VALIDATION_DAY', 5)}}" required>
		</div>
	</div>

	<div class="text-right">
		<button type="submit" class="btn btn-lg btn-primary mt-4">Submit</button>
	</div>
</form>
@endsection