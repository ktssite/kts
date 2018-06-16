@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/styled-input.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Performance</h3>
	</div>
</div>

<div class="row">
	<div class="col-md-12 x_panel">
		<div class="row">
			<div class="col-md-7">
				<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_performance">
					<i class="far fa-plus-square"></i> Add
				</button>
				<button class="btn btn-warning btn-sm" id="edit" disabled><i class="far fa-edit"></i> Edit</button>
				<button class="btn btn-danger btn-sm" id="delete" disabled><i class="fas fa-trash-alt"></i> Delete</button>
			</div>
		</div>
		<div class="row">
			<div class="table-reponsive col-md-12">
				<table class="table table-bordered table-striped table-center table-hover">
					<thead>
						<tr>
							<th>
								<input type="checkbox" name="select_all" id="select_all" value="x">
								<label class="nInput" for="select_all"></label>
							</th>
							<th>Year</th>
							<th>Month</th>
							<th>Week</th>
							<th>Day</th>
							<th>Date</th>
							<th>Porfit</th>
							<th>Equity</th>
							<th>% Change <span class="label label-primary">D</span></th>
							<th>% Change <span class="label label-warning">W</span></th>
							<th>% Change <span class="label label-success">M</span></th>
						</tr>
					</thead>
					<tbody>
						@php 
							$w = $m = 1;
							$performance = range(1,20);
						@endphp
						@forelse ($performance as $i)
							<tr>
								<td class="text-center">
									<input type="checkbox" name="select_all" id="select_{{ $i }}" value="{{ $i }}" class="selectable">
									<label class="nInput" for="select_{{ $i }}"></label>
								</td>
								<td>2018</td>
								<td>June</td>
								<td>06/18/2018 - 06/22/2018</td>
								<td>Monday</td>
								<td>06/18/2018</td>
								<td>$ 30.00</td>
								<td>$ 166.25</td>
								<td><span class="label label-primary p-change">91.01 %</span></td>
								@if($w == 1) 
									<td rowspan="5" class="p-change"><span class="label label-warning">91.01 %</span></td> 
								@endif
								@if($m == 1) 
									<td rowspan="30" class="p-change"><span class="label label-success">91.01 %</span></td> 
								@endif
							</tr>
							@php 
								$w = ($w == 5)?  1: $w+1;
								$m = ($m == 30)? 1: $m+1;
							@endphp
						@empty
						    <tr><td colspan="10">No performance record yet.</td></tr>
						@endforelse
					</tbody>
				</table>					
			</div>
		</div>
	</div>
</div>
@include('performance.create')

@endsection
@push('scripts')
<script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-validate/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#performance_date').datepicker().datepicker('setDate', 'today')
		$("#submit_performance").validate()

		if(!$('.selectable').length) $('#select_all').parent().hide()
		$('input[type=checkbox]').on('click', function() {
			var selected          = $(this)
			var total_checkbox    = $('.selectable').length
			var selected_checkbox = $('.selectable:checked').length

			if(selected.val() == 'x') {
				$('.selectable').prop('checked', selected.is(':checked'))
			} else {
				$('#select_all').prop('checked', selected_checkbox == total_checkbox)
			}

			selected_checkbox = $('.selectable:checked').length
			$('#edit').prop('disabled', selected_checkbox!=1)
			$('#delete').prop('disabled', selected_checkbox==0)
		})


	})
</script>
@endpush