<!-- Modal -->
<div class="modal fade" id="new_performance" tabindex="-1" role="dialog" aria-labelledby="new_performance_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="new_performance_label">
          <i class="far fa-plus-square"></i> New Performance
        </h4>
      </div>
      <form class="submit_performance" action="{{ route('performance.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label class="col-md-3 mt7" for="date">Date</label>
                <div class="col-md-9 mb5">
                  <input type="text" name="date" class="form-control performance_date" id="date" placeholder="Enter date" required autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 mt7" for="instrument">Instruments</label>
                <div class="col-md-9 mb5">
                  <select class="form-control" name="instrument" required id="instrument">
                    <option value="">Select</option>
                    <option value="Forex">Forex</option>
                    <option value="Commodities">Commodities</option>
                    <option value="Index">Index</option>
                  </select>
                </div>
              </div>   

              <div class="form-group">
                <label class="col-md-3 mt7" for="lot_size">Lot size</label>
                <div class="col-md-9 mb5">
                  <input type="number" name="lot_size" class="form-control" id="lot_size" step="0.01" placeholder="Enter Lot size" required>
                </div>
              </div>       

              <div class="form-group">
                <label class="col-md-3 mt7" for="pip">Pips</label>
                <div class="col-md-9 mb5">
                  <input type="number" name="pip" class="form-control" id="pip" step="0.01" placeholder="Enter pips" required>
                </div>
              </div>   

              <div class="form-group">
                <label class="col-md-3 mt7" for="profit">Profit</label>
                <div class="col-md-9 mb5">
                  <input type="number" name="profit" class="form-control" id="profit" step="0.01" placeholder="Enter profit" required>
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