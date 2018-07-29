@extends('layouts.app')

@push('styles')
<link href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<style type="text/css">
.count { font-size: 2em !important; }
ul.top_profiles { min-height:330px; height: auto !important; }
.admin, .student { padding: 5px; border-left: 2px solid #ADB2B5; margin-bottom: 2px; }
.student {  background: #1ABB9C; color: #fff; }
.admin {  background: #eee; color: #5A738E; }
.tile-stats { margin-bottom: 0px; padding-bottom: 0px; }
.tile_stats_count { padding-left: 0px !important; padding-bottom: 0px !important; }
.count_top, .count_bottom { padding-left: 12px; }
.count { margin-top: -5px !important; }
.tile_count { margin: 5px -10px !important; }
.animated { margin-bottom: 5px; }
.search { position: relative; bottom: 34px; }
.btn_submit { float: right !important; }
.week { width: 60px; }
.month { height: 30px; }
.date { width: 100px; }
</style>
@endpush

@section('content')
<div class="title_left">
	<h4>Dashboard</h4>
</div>
<div class="row tile_count">
	@php $admin = auth()->user()->hasRole('Admin') @endphp
	@if(!$admin)
		@include('dashboards.admin_amount')
	@endif
	@include('dashboards.student_amount')
</div>

<div class="row">
	<form action="/dashboard" method="GET">
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
	</form>
</div>
@endsection
@push('scripts')
<script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript"> $('.date').datepicker() </script>
@endpush