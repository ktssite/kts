@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/styled-input.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/jquery-confirm/jquery-confirm.min.css') }}" rel="stylesheet">
<style> 
.card { height: 100px; } 
span.p-change {width: 50px; display: inline-block;}
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
				<form action="{{ route('performance.destroy', 'x') }}" method="POST" id="delete_performance">
					 @method('DELETE') @csrf						
					<div class="row">
						<div class="col-md-4">
							<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_performance">
								<i class="far fa-plus-square"></i> Add
							</button>
							<button type="button" class="btn btn-warning btn-sm" id="edit" disabled data-toggle="modal" data-target="#edit_performance">
								<i class="far fa-edit"></i> Edit
							</button>
							<button type="submit" class="btn btn-danger btn-sm" id="delete" disabled><i class="fas fa-trash-alt"></i> Delete</button>
						</div>		
					</div>
					<div class="table-responsive">				
						<table class="table table-bordered table-striped table-center table-hover jambo_table">
							<thead>
								<tr>
									<th>
										<input type="checkbox" id="select_all" value="x">
										<label class="nInput" for="select_all"></label>
									</th>
									<th>Year</th>
									<th>Month</th>
									<th>Week</th>
									<th>Day</th>
									<th>Date</th>
									<th>Porfit</th>
									<th>Equity</th>
									<th>% Change (D)</th>
									<th>% Change (W)</th>
									<th>% Change (M)</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($performances as $key => $performance)
									<tr>
										<td class="text-center">
											<input type="checkbox" name="selected_items[]" id="select_{{ $key }}" value="{{ $performance->id }}" class="selectable"
											 data-id="{{ $performance->id }}" data-date="{{ $performance->date }}" data-profit="{{ _d($performance->profit) }}"
											><label class="nInput" for="select_{{ $key }}"></label>
										</td>
										<td>{{ $performance->year }}</td>
										<td>{{ $performance->month }}</td>
										<td>{{ $performance->week }}</td>
										<td>{{ $performance->day }}</td>
										<td>{{ $performance->date }}</td>
										<td>$ {{ _d($performance->profit) }}</td>
										<td>$ {{ $performance->equity }}</td>
										<td>
											<span class="label label-primary p-change">{{ $performance->daily_change }} %</span>
										</td>
										@if($performance->w_col) 
											<td rowspan="5" class="p-change">
												<span class="label label-warning">{{ $performance->weekly_change }} %</span>
											</td> 
										@endif
										@if($performance->m_col) 
											<td rowspan="30" class="p-change">
												<span class="label label-success">{{ $performance->monthly_change }} %</span>
											</td>
										 @endif
									</tr>
								@empty
								    <tr><td colspan="10">No records performance yet.</td></tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</form>
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
<script type="text/javascript">
	$(document).ready(function() {
		$('.performance_date').datepicker().datepicker('setDate', 'today')
		$(".submit_performance").validate()
		$("#delete_performance").validate({
		    submitHandler: function(form) {
				$.confirm({
				    title: 'Are you sure?',
				    content: 'Please confirm.',
				    buttons: {
				        confirm: function () {
				            form.submit()
				        },
				        cancel: function () {},
				    }
				});
		    }			
		})		

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

		$('#edit').click(function() {
			var data = $('.selectable:checked').data();
			console.log(data)
			$('[name=pid]').val(data.id)
			$('[name=e_date]').val(data.date)
			$('[name=e_profit]').val(data.profit)
		})
	})
</script>
@endpush