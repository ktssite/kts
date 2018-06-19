<div class="x_panel">
	<div class="x_title">
		<h2>Monthly <small>Rankings</small></h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<ul class="list-unstyled top_profiles scroll-view">
			@foreach(range(1,20) as $i)
			<li class="media event">
				<a class="pull-left border-aero profile_thumb"><i class="fa fa-user aero"></i></a>
				<div class="media-body">
					<a class="title" href="#">Ms. Mary Jane</a>
					<p><strong>$2300. </strong> Agent Avarage Sales </p>
					<p> <small class="label label-success">Top 1</small></p>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>