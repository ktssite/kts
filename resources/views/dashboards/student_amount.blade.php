<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="tile-stats">
		<div class="title">
			<h4 class="student">My Portfolio</h4>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
		  <span class="count_top">Available Equity</span>
		  <div class="count">$ {{ $amounts['student']['available_equity'] }}</div>
		  <span class="count_bottom"><i>Deposits + Profits - Withdrawals</i></span>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
		  <span class="count_top">Total Profits</span>
		  <div class="count">$ {{ $amounts['student']['total_profits'] }}</div>
		  <span class="count_bottom"><i>Combined daily profits</i></span>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
		  <span class="count_top">Total Deposits</span>
		  <div class="count">$ {{ $amounts['student']['total_deposits'] }}</div>
		  <span class="count_bottom"><i>Additional amounts to the equity</i></span>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
		  <span class="count_top">Total Withdrawals</span>
		  <div class="count">$ {{ $amounts['student']['total_withdrawals'] }}</div>
		  <span class="count_bottom"><i>Amounts deducted from the equity</i></span>
		</div>
	</div>
</div>