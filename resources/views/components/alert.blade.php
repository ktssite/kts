@if(Session::has('alert'))
@php $alert = Session::get('alert')  @endphp
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-{{ $alert['type'] }} alert-dismissible fade in" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">×</span>
		    </button>
		    {{ $alert['message'] }}
		</div>
	</div>
</div>
@endif