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

			<div class="form-group col-md-3">
				<label class="col-md-3 mt7" for="filterd_date">Date</label>
				<div class="col-md-9">
                  	<input type="text" name="d" class="form-control filter_date" id="filterd_date" placeholder="Enter date" required autocomplete="off" value="{{ Request::get('d')? Request::get('d'): date('m/d/Y')}}">
				</div>
			</div>	

			<div class="form-group col-md-3">
				<button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
			</div>
		</form>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					@foreach(['Students', 'Year', 'Month', 'Week', 'Day', 'Date', 'Instruments', 'Lot size', 'Pip', 'Profit', 'Equity'] as $head)
						<th>{{ $head }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@forelse($group_performance as $group)
					<tr>
						<td>{{ $group->user->name }}</td>
						<td>{{ $group->year }}</td>
						<td>{{ $group->month }}</td>
						<td>{{ $group->week }}</td>
						<td>{{ $group->day }}</td>
						<td>{{ _date($group->date) }}</td>
						<td>{{ $group->instrument }}</td>
						<td>{{ _d($group->lot_size) }}</td>
						<td>{{ _d($group->pip) }}</td>
						<td>$ {{ _d($group->profit) }}</td>
						<td>$ {{ _d($group->user->available_equity) }}</td>
					</tr>
				@empty
				    <tr><td colspan="13" class="text-center">No records for performance yet.</td></tr>
				@endforelse
			</tbody>
		</table>
	</div>