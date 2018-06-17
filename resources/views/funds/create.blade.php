<!-- Modal -->
<div class="modal fade" id="new_fund" tabindex="-1" role="dialog" aria-labelledby="new_fund_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="new_fund_label">
          <i class="far fa-plus-square"></i> New Fund
        </h4>
      </div>
      <form class="submit_fund" action="{{ route('fund.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="form-group">
                  <label>Type</label>
                  <select class="form-control" name="type" required>
                  	<option value="">Select</option>
                  	<option value="Deposit">Deposit</option>
                  	<option value="Withdraw">Withdraw</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="form-group">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
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