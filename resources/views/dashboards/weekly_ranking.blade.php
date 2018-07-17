<div class="x_panel">
	<div class="x_title">
		<h2>Weekly <small>Rankings</small></h2>
		<div class="clearfix"></div>
		<span class="right">
			<div class="btn-group search">	
				<input type="number" name="w" class="from-control btn btn-default btn-sm week"
					   autocomplete="off" placeholder="Week" required step="1" max="53" 
					   value="{{ $week }}">
			    <button type="submit" class="btn btn-sm btn btn-primary btn_submit"><i class="fas fa-search"></i></button>
			</div>
		</span>
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