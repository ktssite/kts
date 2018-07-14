<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
		<!-- <div class="icon"><i class="fas fa-hand-holding-usd"></i></div> -->
		<div class="count">$ {{ $amounts['available_equity'] }}</div>
		<h3>Available Equity</h3>
		<p>Deposits + Profits - Withdrawals</p>
	</div>
</div>

<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
		<!-- <div class="icon"><i class="fas fa-chart-line"></i></div> -->
		<div class="count">$ {{ $amounts['total_profits'] }}</div>
		<h3>Total Profits</h3>
		<p>Combined daily profits</p>
	</div>
</div>

<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
		<!-- <div class="icon"><i class="fas fa-plus"></i></i></div> -->
		<div class="count">$ {{ $amounts['total_deposits'] }}</div>
		<h3>Total Deposits</h3>
		<p>Additional amounts to the equity</p>
	</div>
</div>

<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
		<!-- <div class="icon"><i class="fas fa-minus"></i></div> -->
		<div class="count">$ {{ $amounts['total_withdrawals'] }}</div>
		<h3>Total Withdrawals</h3>
		<p>Amounts deducted from the equity</p>
	</div>
</div>