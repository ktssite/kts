<div class="x_panel">
	<div class="x_title">
		<h2>Weekly</h2>
		<div class="clearfix">
			<span class="right">
				<div class="btn-group search">	
					<input type="number" name="w" class="from-control btn btn-default btn-sm week"
						   autocomplete="off" placeholder="Week" required step="1" max="53" 
						   value="{{ $week }}">
				    <button type="submit" class="btn btn-sm btn btn-primary btn_submit"><i class="fas fa-search"></i></button>
				</div>
			</span>			
		</div>
	</div>
	<div class="x_content">
		<ul class="list-unstyled top_profiles scroll-view">
			@foreach($week_rankings as $weekly)
			<li class="media event">
				<a class="pull-left border-aero profile_thumb"><i class="fa fa-user aero"></i></a>
				<div class="media-body">
					<a class="title" href="#">{{ $weekly->name }}</a>
					<p>
						@if($weekly->week_change > 0)
							<i class="fas fa-arrow-up text-success"></i>						
							<strong class="text-success">{{ $weekly->week_change }} %</strong>
						@elseif($weekly->week_change < 0)
							<i class="fas fa-arrow-down text-danger"></i>						
							<strong class="text-danger">{{ abs($weekly->week_change) }} %</strong>						
						@else
							<strong>{{ $weekly->week_change }} %</strong>
						@endif						
					</p>
					<p> <small>Week {{ $weekly->week }}</small></p>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>