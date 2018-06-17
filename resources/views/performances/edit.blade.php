<!-- Modal -->
<div class="modal fade" id="edit_performance" tabindex="-1" role="dialog" aria-labelledby="new_performance_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="new_performance_label">
          <i class="far fa-edit"></i> Edit Performance
        </h4>
      </div>
      <form class="submit_performance" action="{{ route('performance.update', 'e') }}" method="POST">
        @method('PUT') @csrf	
        <input type="hidden" name="pid">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="e_date" class="form-control performance_date" placeholder="Enter date" required autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="form-group">
                <label>Profit</label>
                <input type="number" name="e_profit" class="form-control" placeholder="Enter profit" required>
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