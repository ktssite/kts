<div class="row">
	<div class="col-md-4">
		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_performance">
			<i class="far fa-plus-square"></i> Add
		</button>
	</div>		
</div>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				@foreach(['Details', 'Year', 'Month', 'Week', 'Day', 'Date', 'Profit', 'Equity'] as $head)
					<th>{{ $head }}</th>
				@endforeach
				<th class="text-center">Change (D)</th>
				<th class="text-center">Change (W)</th>
				<th class="text-center">Change (M)</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($performances as $key => $performance)
				<tr class="main">
					<td>
						<i class="fas fa-bars"></i>
						<label class="label label-default">({{ count($performance->details) }})</label> 
					</td>
					<td>{{ $performance->year }}</td>
					<td>{{ month($performance->month) }}</td>
					<td>{{ $performance->week }}</td>
					<td>{{ $performance->day }}</td>
					<td>{{ _date($performance->date) }}</td>
					<td>
						@if($performance->profit>=0)
							<strong class="text text-success">$ {{ _d($performance->profit) }}</strong>
						@else
							<strong class="text text-danger">$ {{ _d($performance->profit) }}</strong>
						@endif		
					</td>
					<td>$ {{ _d($performance->equity) }}</td>
					<td class="text-center v-middle">
						@if($performance->daily_change > 0)
							<i class="fas fa-arrow-up text-success"></i>
							<strong class="text-success">{{ $performance->daily_change }} %</strong>
						@elseif($performance->daily_change < 0)
							<i class="fas fa-arrow-down text-danger"></i>
							<strong class="text-danger">{{ abs($performance->daily_change) }} %</strong>
						@else
							<strong>{{ $performance->daily_change }} %</strong>
						@endif
					</td>
					@if($performance->w_col) 
						<td rowspan="{{ $performance->rs_w }}" class="text-center v-middle">
						@if($performance->weekly_change > 0)
							<i class="fas fa-arrow-up text-success"></i>
							<strong class="text-success">{{ $performance->weekly_change }} %</strong>
						@elseif($performance->weekly_change < 0)
							<i class="fas fa-arrow-down text-danger"></i>
							<strong class="text-danger">{{ abs($performance->weekly_change) }} %</strong>
						@else
							<strong>{{ abs($performance->weekly_change) }} %</strong>							
						@endif
						</td> 
					@endif
					@if($performance->m_col) 
						<td rowspan="{{ $performance->rs_m }}" class="text-center v-middle">
						@if($performance->monthly_change > 0)
							<i class="fas fa-arrow-up text-success"></i>
							<strong class="text-success">{{ $performance->monthly_change }} %</strong>
						@elseif($performance->monthly_change < 0)
							<i class="fas fa-arrow-down text-danger"></i>
							<strong class="text-danger">{{ abs($performance->monthly_change) }} %</strong>
						@else
							<strong>{{ abs($performance->monthly_change) }} %</strong>														
						@endif
						</td>
					 @endif
				</tr>
				<tr class="collapsed_row">
					<td colspan="9">
						<ul class="to_do">
							<li>
								<div class="row">
									<div class="col-md-2 col-sm-2 col-xs-2"><label class="label label-default">Action</label></div>
									<div class="col-md-2 col-sm-2 col-xs-2"><label class="label label-default">Instrument</label></div>
									<div class="col-md-2 col-sm-2 col-xs-2"><label class="label label-default">Lot size</label></div>
									<div class="col-md-2 col-sm-2 col-xs-2"><label class="label label-default">Pips</label></div>
									<div class="col-md-4 col-sm-4 col-xs-4"><label class="label label-default">Profit</label></div>
								</div>	
							</li>
							@foreach($performance->details as $detail)
								<li>								
									<div class="row">
										<div class="col-md-2 col-sm-2 col-xs-2">
											<button 
												type="button" 
												class="action btn btn-warning btn-xs edit_performance" 
												data-toggle="modal" data-target="#edit_performance"
												data-pid="{{ $detail['id'] }}"
												data-e_date="{{ $performance->date }}"
												data-e_instrument="{{ $detail['instrument'] }}"
												data-e_lot_size="{{ _d($detail['lot_size']) }}"
												data-e_pip="{{ _d($detail['pip']) }}"
												data-e_profit="{{ _d($detail['profit']) }}"
											>
												<i class="far fa-edit"></i>
											</button>
											<form action="{{ route('performance.destroy', $detail['id']) }}" method="POST" class="inline">
												 @method('DELETE') @csrf													
												<button type="button" class="action btn btn-danger btn-xs delete_performance"><i class="far fa-trash-alt"></i></button>
											</form>
										</div>
										<div class="col-md-2 col-sm-2 col-xs-2">{{ $detail['instrument'] }}</div>
										<div class="col-md-2 col-sm-2 col-xs-2">{{ _d($detail['lot_size']) }}</div>
										<div class="col-md-2 col-sm-2 col-xs-2">{{ _d($detail['pip']) }}</div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											@if($detail['profit']>=0)
												<strong class="text-success">$ {{ _d($detail['profit']) }}</strong>
											@else
												<strong class="text-danger">$ {{ _d($detail['profit']) }}</strong>
											@endif
										</div>
									</div>
								</li>
							@endforeach
						</ul>
					</td>
				</tr>					
			@empty
			    <tr><td colspan="13" class="text-center">No records for performance yet.</td></tr>
			@endforelse
		</tbody>
	</table>
</div>