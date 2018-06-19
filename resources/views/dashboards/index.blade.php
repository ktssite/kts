@extends('layouts.app')

@push('styles')
<style type="text/css">
.count { font-size: 2.2em !important; }
ul.top_profiles { min-height: 63vh; overflow-y: auto; }
</style>
@endpush

@section('content')
<div class="title_left">
	<h3>Dashboard</h3>
</div>
<div class="row top_tiles">
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			<div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
			<div class="count">$ {{ $amounts['available_equity'] }}</div>
			<h3>Available Equity</h3>
			<p>Deposits + Profits - Withdrawals</p>
		</div>
	</div>

	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			<div class="icon"><i class="fas fa-chart-line"></i></div>
			<div class="count">$ {{ $amounts['tota_profits'] }}</div>
			<h3>Total Profits</h3>
			<p>Combined daily profits</p>
		</div>
	</div>

	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			<div class="icon"><i class="fas fa-plus"></i></i></div>
			<div class="count">$ {{ $amounts['total_deposits'] }}</div>
			<h3>Total Deposits</h3>
			<p>Additional amounts to the equity</p>
		</div>
	</div>

	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			<div class="icon"><i class="fas fa-minus"></i></div>
			<div class="count">$ {{ $amounts['total_withdrawals'] }}</div>
			<h3>Total Withdrawals</h3>
			<p>Amounts deducted from the equity</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="x_panel">
			<div class="x_title">
				<h2>Daily <small>Rankings</small></h2>
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
	</div>	

	<div class="col-md-4">
		<div class="x_panel">
			<div class="x_title">
				<h2>Weekly <small>Rankings</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<ul class="list-unstyled top_profiles scroll-view">
				  <li class="media event">
				    <a class="pull-left border-aero profile_thumb">
				      <i class="fa fa-user aero"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				  <li class="media event">
				    <a class="pull-left border-green profile_thumb">
				      <i class="fa fa-user green"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				  <li class="media event">
				    <a class="pull-left border-blue profile_thumb">
				      <i class="fa fa-user blue"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				  <li class="media event">
				    <a class="pull-left border-aero profile_thumb">
				      <i class="fa fa-user aero"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				  <li class="media event">
				    <a class="pull-left border-green profile_thumb">
				      <i class="fa fa-user green"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				</ul>
			</div>
		</div>
	</div>		

	<div class="col-md-4">
		<div class="x_panel">
			<div class="x_title">
				<h2>Monthly <small>Rankings</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<ul class="list-unstyled top_profiles scroll-view">
				  <li class="media event">
				    <a class="pull-left border-aero profile_thumb">
				      <i class="fa fa-user aero"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				  <li class="media event">
				    <a class="pull-left border-green profile_thumb">
				      <i class="fa fa-user green"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				  <li class="media event">
				    <a class="pull-left border-blue profile_thumb">
				      <i class="fa fa-user blue"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				  <li class="media event">
				    <a class="pull-left border-aero profile_thumb">
				      <i class="fa fa-user aero"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				  <li class="media event">
				    <a class="pull-left border-green profile_thumb">
				      <i class="fa fa-user green"></i>
				    </a>
				    <div class="media-body">
				      <a class="title" href="#">Ms. Mary Jane</a>
				      <p><strong>$2300. </strong> Agent Avarage Sales </p>
				      <p> <small>12 Sales Today</small>
				      </p>
				    </div>
				  </li>
				</ul>
			</div>
		</div>
	</div>		
</div>
@endsection
@push('scripts')

@endpush