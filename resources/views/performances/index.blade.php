@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/styled-input.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/jquery-confirm/jquery-confirm.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/fSelect/fSelect.css') }}" rel="stylesheet">
<style> 
.card { height: 100px; } 
span.p-change {width: 50px; display: inline-block;}
.mb5 { margin-bottom: 5px; }
.mt7 { margin-top: 7px; }
.fs-wrap { width: 100% }
.fs-dropdown { width: 95% }
.fs-search { padding: 5px; }
.fs-label { height: 33px; }
.fs-option-label { margin: 5px; }
.fs-label-wrap .fs-label { padding-top: 11px; }
</style>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Performance</h2>
				@include('components.alert')
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				@if(auth()->user()->hasRole('Admin'))
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
							<li role="presentation" class="active"><a href="#group" role="tab" id="group-tab" data-toggle="tab" aria-expanded="false">Group</a></li>
							<li role="presentation" class=""><a href="#personal" id="personal-tab" role="tab" data-toggle="tab" aria-expanded="true">Personal</a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="group" aria-labelledby="group-tab">
								@include('performances.group')
							</div>
							<div role="tabpanel" class="tab-pane fade" id="personal" aria-labelledby="personal-tab">
								@include('performances.personal')
							</div>
						</div>
					</div>
				@else
					@include('performances.personal')
				@endif
			</div>
		</div>
	</div>	
</div>
@include('performances.create')
@include('performances.edit')
@endsection
@push('scripts')
<script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-confirm/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('vendors/fSelect/fSelect.js') }}"></script>
<script src="{{ asset('js/app/performance.js') }}"></script>
@endpush