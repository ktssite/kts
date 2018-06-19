@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/styled-input.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/jquery-confirm/jquery-confirm.min.css') }}" rel="stylesheet">
<style> 
.btn-xs { margin-bottom: 0; }
.btn-width { width: 90px; text-align: right}
.btn-width span:first-child { float: left }
.btn-group { margin-bottom: 5px; }
.pr-15 { padding-right: 15px !important;}
</style>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Funds</h2>
				@include('components.alert')
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<div class="row">
					<div class="col-md-6">
						<div class="btn-group btn-group-sm" data-toggle="modal" data-target="#new_fund">
							<button type="button" class="btn btn-width btn-success" onclick="$('#new_fund_label').html('Deposit');$('[name=type]').val('Deposit')">
								<i class="far fa-plus-square"></i> Deposit
							</button>
							<button type="button" class="btn btn-width btn-danger" onclick="$('#new_fund_label').html('Withdraw');$('[name=type]').val('Withdraw')">
								<i class="far fa-minus-square"></i> Withdraw
							</button>
						</div>
					</div>
					<div class="col-md-6 text-right">
						<div class="btn-group btn-group-sm filter">
							<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-width" type="button" aria-expanded="false"> 
								<span>{{ in_array(Request::get('d'), ['','all'])? 'All': Request::get('d') }}</span>
								<span class="caret"></span> 
							</button>
							<ul class="dropdown-menu">
								<li><a href="?d=all">All</a></li>
								<li><a href="?d=Deposit">Deposit</a></li>
								<li><a href="?d=Withdraw">Withdraw</a></li>
							</ul>
							<button type="button" class="btn btn-primary">Filter</button>
						</div>						
					</div>	
				</div>	

				<div class="table-responsive">
					<table class="table table-striped jambo_table bulk_action">
						<thead>
							<tr class="headings">
								<th>Type</th>
								<th>Date</th>
								<th>Amount</th>
								<th class="text-right pr-15">Action</th>			
							</tr>
						</thead>

						<tbody>
							@forelse ($funds as $key => $fund)
								<tr>
									<td>
										<span class="label label-{{ ($fund->type=='Deposit')?'success':'danger' }} btn-xs">{{ $fund->type }}</span>
									</td>
									<td>{{ $fund->created_at }}</td>
									<td>$ {{ _d($fund->amount) }}</td>
									<td class="text-right">
										<form class="delete_fund" action="fund/{{ $fund->id }}" method="POST" data-type="delete">
											@method('DELETE') @csrf	
											<button type="submit" class="btn btn-warning btn-xs"><i class="fas fa-trash-alt"></i> Delete</button>
										</form>
									</td>
								</tr>
							@empty
							    <tr><td colspan="10" class="text-center">No record for funds yet.</td></tr>
							@endforelse
						</tbody>
					</table>
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
		$(".delete_fund").each(function() {
			$(this).validate({
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
		})

		$('.submit_fund').validate()
	})


</script>
@endpush