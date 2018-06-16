<!-- Modal -->
<div class="modal fade" id="new_performance" tabindex="-1" role="dialog" aria-labelledby="new_performance_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="new_performance_label">
          <i class="far fa-plus-square"></i> New Performance
        </h4>
      </div>
      <form id="submit_performance" action="{{ route('performance.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="date" class="form-control" placeholder="Enter date" id="performance_date" required autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="form-group">
                <label>Profit</label>
                <input type="number" name="profit" class="form-control" placeholder="Enter profit" required>
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