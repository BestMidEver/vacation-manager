@if ($data->lastpage() > 1)
<nav aria-label="Page navigation" class="mt-5">
	<ul class="pagination justify-content-center mb-0">
		@if (!$data->onFirstPage())
		<li class="page-item">
			<a class="page-link" href="{{ $data->previousPageUrl() }}">Previous</a>
		</li>
		@endif
		@if ($data->hasMorePages())
		<li class="page-item">
			<a class="page-link" href="{{ $data->nextPageUrl() }}">Next</a>
		</li>
		@endif
	</ul>
	<div class="text-center mt-2">
		<span class="text-muted" aria-hidden="true"><small>{{ $data->firstItem() }} - {{ $data->lastItem() }} <span class="px-2">of</span> {{ $data->total() }}</small></span>
	</div>
</nav>
@endif