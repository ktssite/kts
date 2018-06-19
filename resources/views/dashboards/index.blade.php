@extends('layouts.app')

@push('styles')
<style type="text/css">
.count { font-size: 2.2em !important; }
ul.top_profiles { min-height: 63vh; overflow-y: auto; }
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
	<div class="col-md-4">
		@include('dashboards.daily_ranking')
	</div>	

	<div class="col-md-4">
		@include('dashboards.weekly_ranking')
	</div>		

	<div class="col-md-4">
		@include('dashboards.monthly_ranking')
	</div>		
</div>
@endsection
@push('scripts')

@endpush