<div class="x_panel">
	<div class="x_title">
		<h2>Weekly <small>Rankings</small></h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<ul class="list-unstyled top_profiles scroll-view">
			@foreach($weekly_rankings as $weekly)
			<li class="media event">
				<a class="pull-left border-aero profile_thumb"><i class="fa fa-user aero"></i></a>
				<div class="media-body">
					<a class="title" href="#">{{ $weekly->name }}</a>
					<p><strong class="label label-warning">{{ $weekly->weekly_change }} %</strong></p>
					<p> <small>Week {{ $weekly->week }}</small></p>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>