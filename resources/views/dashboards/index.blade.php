@extends('layouts.app')

@push('styles')
<style type="text/css">
.count { font-size: 2.2em !important; }
</style>
@endpush

@section('content')
<div class="title_left">
	<h3>Dashboard</h3>
</div>
<div class="row top_tiles">
	@include('dashboards.amounts_tracker')
</div>

<div class="row">
	@php $admin = auth()->user()->hasRole('Admin') @endphp
	<div class="col-md-{{ 3 + !$admin }}">
		@include('dashboards.daily_ranking')
	</div>	

	<div class="col-md-{{ 3 + !$admin }}">
		@include('dashboards.weekly_ranking')
	</div>		

	<div class="col-md-{{ 3 + !$admin }}">
		@include('dashboards.monthly_ranking')
	</div>	

	@if($admin)
		<div class="col-md-3">
			@include('dashboards.equity_summary')
		</div>	
	@endif
</div>
@endsection
@push('scripts')

@endpush