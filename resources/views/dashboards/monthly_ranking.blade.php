<div class="x_panel">
	<div class="x_title">
		<h2>Monthly <small>Rankings</small></h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<ul class="list-unstyled top_profiles scroll-view">
			@foreach($monthly_rankings as $monthly)
			<li class="media event">
				<a class="pull-left border-aero profile_thumb"><i class="fa fa-user aero"></i></a>
				<div class="media-body">
					<a class="title" href="#">{{ $monthly->name }}</a>
					<p><strong class="label label-success">{{ $monthly->monthly_change }} %</strong></p>
					<p> <small>Month of {{ $monthly->month }}</small></p>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>