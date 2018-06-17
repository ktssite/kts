@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/styled-input.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/jquery-confirm/jquery-confirm.min.css') }}" rel="stylesheet">
<style> 
.card { height: 100px; } 
.form-inline-group { display: flex }

</style>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Funds</h3>
	</div>
</div>
@include('components.alert')
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">	
			<div class="row">
				<div class="col-md-3">
					<div class="form-inline-group">
					<select class="form-control" name="type">
						<option value="all">All</option>
						<option value="deposit">Deposit</option>
						<option value="withdraw">Withdraw</option>
					</select>
					</div>
				</div>
				<div class="col-md-9 text-right">
					<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_fund">
						<i class="far fa-plus-square"></i> Add
					</button>
				</div>		
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>Date</th>
									<th>Type</th>
									<th>Amount</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($funds as $key => $fund)
									<tr>
										<td>{{ $fund->created_at }}</td>
										<td>{{ $fund->type }}</td>
										<td>$ {{ _d($fund->amount) }}</td>
										<td class="text-right">
											<form class="submit_fund" action="fund/{{ $fund->id }}" method="POST" data-type="delete">
												@method('DELETE') @csrf	
												<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
											</form>
										</td>
									</tr>
								@empty
								    <tr><td colspan="10" class="text-center">No record funds yet.</td></tr>
								@endforelse
							</tbody>
						</table>					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('funds.create')

@endsection
@push('scripts')
<script src="{{ asset('vendors/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-confirm/jquery-confirm.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".submit_fund").validate({
		    submitHandler: function(form) {
		    	// if($(this).data('type') == 'delete')
				$.confirm({
				    title: 'Are you sure?',
				    content: 'Please confirm.',
				    buttons: {
				        confirm: function () {
				            form.submit()
				        },
				        cancel: function () {
				            console.log($(form).data('type'))
				        },
				    }
				});
		    }			
		})
	})


</script>
@endpush