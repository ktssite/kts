<div class="x_panel">
	<div class="x_title">
		<h2>Monthly <small>Rankings</small></h2>
		<div class="clearfix"></div>
		<span class="right">
			<div class="btn-group search">	
				<select class="btn btn-sm btn-default month" name="m" required>
					@foreach(range(1, 12) as $m)
						<option value="{{ $m }}" @if($m == $month) selected @endif>{{ month($m) }}</option>
					@endforeach
				</select>
			    <button type="submit" class="btn btn-sm btn btn-primary btn_submit"><i class="fas fa-search"></i></button>
			</div>
		</span>		
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