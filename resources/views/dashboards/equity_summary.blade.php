<div class="x_panel">
	<div class="x_title">
		<h2>Equity <small>Summary</small></h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<ul class="list-unstyled top_profiles scroll-view">
			@foreach($equity_summary as $summary)
			<li class="media event">
				<a class="pull-left border-aero profile_thumb"><i class="fa fa-user aero"></i></a>
				<div class="media-body">
					<a class="title" href="#">{{ $summary->name }}</a>
					<p><strong>$ {{ _d($summary->available_equity) }}</strong></p>
					<p> <small>As of {{ $summary->getLatestProfitDate() }}</small></p>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>