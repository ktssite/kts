	<div class="row">
		<form action="/performance" method="GET">			
			<div class="form-group col-md-5">
				<label class="col-md-2 mt7">Students</label>
				<div class="col-md-10">
					<select name="s[]" class="form-control" id="students" multiple placeholder="Select Multiple students">
						<option value="">All</option>
						@foreach($students as $student)
							<option value="{{ $student->id }}" 
								@if(in_array($student->id, (array)Request::get('s'))) selected @endif
							>{{ $student->name }}</option>
						@endforeach
					</select>
				</div>
			</div>	

			<div class="form-group col-md-5">
				<label class="col-md-2 mt7" for="filterd_date">Date</label>
				<div class="col-md-5">
                  	<input type="text" name="from" class="form-control filter_date" id="filterd_date" placeholder="From" required autocomplete="off" value="{{ Request::get('from')? Request::get('from'): date('m/d/Y')}}">
				</div>
				<div class="col-md-5">
                  	<input type="text" name="to" class="form-control filter_date" id="filterd_date" placeholder="To" autocomplete="off" value="{{ Request::get('to')? Request::get('to'): '' }}">
				</div>				
			</div>	


			<div class="form-group col-md-2">
				<button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
			</div>
		</form>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="10%">Details</th>
					@foreach(['Students', 'Year', 'Month', 'Week', 'Day', 'Date', 'Profit', 'Equity'] as $head)
						<th>{{ $head }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@forelse($group_performance as $id => $group)
					<tr class="main">
						<td>
							<i class="fas fa-bars"></i>
							<label class="label label-default">({{ count($group->details) }})</label> 
						</td>						
						<td>{{ $group->student }}</td>
						<td>{{ $group->year }}</td>
						<td>{{ $group->month }}</td>
						<td>{{ $group->week }}</td>
						<td>{{ $group->day }}</td>
						<td>{{ _date($group->date) }}</td>
						<td>
							@if($group->profit>=0)
								<label class="label label-success">$ $ {{ _d($group->profit) }}</label>
							@else
								<label class="label label-danger">$ $ {{ _d($group->profit) }}</label>
							@endif							
						</td>
						<td>$ {{ _d($group->equity) }}</td>
					</tr>
					<tr class="collapsed_row">
						<td colspan="9">
							<ul class="to_do">
								<li>
									<div class="row">
										<div class="col-md-3 col-sm-3 col-xs-3"><label class="label label-default">Instrument</label></div>
										<div class="col-md-3 col-sm-3 col-xs-3"><label class="label label-default">Lot size</label></div>
										<div class="col-md-3 col-sm-3 col-xs-3"><label class="label label-default">Pips</label></div>
										<div class="col-md-3 col-sm-3 col-xs-3"><label class="label label-default">Profit</label></div>
									</div>	
									</div>	
								</li>
								@foreach($group->details as $detail)
									<li>								
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">{{ $detail['instrument'] }}</div>
											<div class="col-md-3 col-sm-3 col-xs-3">{{ _d($detail['lot_size']) }}</div>
											<div class="col-md-3 col-sm-3 col-xs-3">{{ _d($detail['pip']) }}</div>
											<div class="col-md-3 col-sm-3 col-xs-3">
												@if($detail['profit']>=0)
													<label class="label label-success">$ {{ _d($detail['profit']) }}</label>
												@else
													<label class="label label-danger">$ {{ $detail['profit'] }}</label>
												@endif
											</div>
										</div>
									</li>
								@endforeach
							</ul>
						</td>
					</tr>
				@empty
				    <tr><td colspan="9" class="text-center">No records for performance yet.</td></tr>
				@endforelse
			</tbody>
		</table>
	</div>