<form action="{{ route('performance.destroy', 'x') }}" method="POST" id="delete_performance">
	 @method('DELETE') @csrf						
	<div class="row">
		<div class="col-md-4">
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_performance">
				<i class="far fa-plus-square"></i> Add
			</button>
			<button type="button" class="btn btn-warning btn-sm" id="edit" disabled data-toggle="modal" data-target="#edit_performance">
				<i class="far fa-edit"></i> Edit
			</button>
			<button type="submit" class="btn btn-danger btn-sm" id="delete" disabled><i class="fas fa-trash-alt"></i> Delete</button>
		</div>		
	</div>
	<div class="table-responsive">
		<table class="table table-center table-bordered table-hover">
			<thead>
				<tr>
					<th>
						<input type="checkbox" id="select_all" value="x">
						<label class="nInput" for="select_all"></label>
					</th>
					@foreach(['Year', 'Month', 'Week', 'Day', 'Date', 'Instruments', 'Lot size', 'Pip', 'Profit', 'Equity', '% Change (D)', '% Change (W)', '% Change (M)'] as $head)
						<th>{{ $head }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@forelse ($performances as $key => $performance)
					<tr>
						<td class="text-center">
							<input type="checkbox" 
								   name="selected_items[]" 
								   id="select_{{ $key }}" 
								   value="{{ $performance->id }}" 
								   class="selectable"
							 	   data-id="{{ $performance->id }}" 
							 	   data-date="{{ $performance->date }}" 
							 	   data-instrument="{{ $performance->instrument }}"
							 	   data-lot_size="{{ _d($performance->lot_size) }}"
							 	   data-pip="{{ _d($performance->pip) }}"
							 	   data-profit="{{ _d($performance->profit) }}"
							><label class="nInput" for="select_{{ $key }}"></label>
						</td>
						<td>{{ $performance->year }}</td>
						<td>{{ $performance->month }}</td>
						<td>{{ $performance->week }}</td>
						<td>{{ $performance->day }}</td>
						<td>{{ $performance->date }}</td>
						<td>{{ $performance->instrument }}</td>
						<td>{{ _d($performance->lot_size) }}</td>
						<td>{{ _d($performance->pip) }}</td>
						<td>$ {{ _d($performance->profit) }}</td>
						<td>$ {{ $performance->equity }}</td>
						<td>
							<span class="label label-primary p-change">{{ $performance->daily_change }} %</span>
						</td>
						@if($performance->w_col) 
							<td rowspan="5" class="p-change">
								<span class="label label-warning">{{ $performance->weekly_change }} %</span>
							</td> 
						@endif
						@if($performance->m_col) 
							<td rowspan="30" class="p-change">
								<span class="label label-success">{{ $performance->monthly_change }} %</span>
							</td>
						 @endif
					</tr>
				@empty
				    <tr><td colspan="13">No records for performance yet.</td></tr>
				@endforelse
			</tbody>
		</table>
	</div>
</form>