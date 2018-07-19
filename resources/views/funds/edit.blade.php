<!-- Modal -->
<div class="modal fade" id="edit_fund" tabindex="-1" role="dialog" aria-labelledby="new_fund_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="new_fund_label">Edit Fund</h4>
      </div>
      <form class="edit_form_fund" action="{{ route('fund.update', 'e') }}" method="POST">
      	<input type="hidden" name="fid">
        @method('PUT') @csrf	
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="form-group">
	                <label>Type</label>
	                <input type="text" name="e_type" class="form-control" placeholder="Enter type" required readonly>
                </div>                        	
                <div class="form-group">
	                <label>Actual date added</label>
	                <input type="text" name="e_date" class="form-control date" placeholder="Enter date" required autocomplete="off">
                </div>              	
                <div class="form-group">
	                <label>Amount</label>
	                <input type="number" name="e_amount" class="form-control" placeholder="Enter amount" required>
                </div>
              </div>
            </div>          
          </div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
        
    </div>
  </div>
</div>