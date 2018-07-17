<div class="x_panel">
	<div class="x_title">
		<h2>Daily <small>Rankings</small></h2>
		<div class="clearfix"></div>
		<span class="right">
			<div class="btn-group search">
				<input type="text" name="d" class="from-control btn btn-default btn-sm date" autocomplete="off" placeholder="Date" required
					   value="{{ $date }}">
			    <button type="submit" class="btn btn-sm btn btn-primary btn_submit"><i class="fas fa-search"></i></button>
			</div>
		</span>
	</div>
	<div class="x_content">
		<ul class="list-unstyled top_profiles scroll-view">
			@foreach($daily_rankings as $daily)
			<li class="media event">
				<a class="pull-left border-aero profile_thumb"><i class="fa fa-user aero"></i></a>
				<div class="media-body">
					<a class="title" href="#">{{ $daily->name }}</a>
					<p><strong class="label label-primary">{{ $daily->daily_change }} %</strong></p>
					<p> <small>{{ $daily->date }}</small></p>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>