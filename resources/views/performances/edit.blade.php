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
            <div class="col-md-9">
              <div class="form-group">
                <label class="col-md-3 mt7" for="e_date">Date</label>
                <div class="col-md-9 mb5">
                  <input type="text" name="e_date" class="form-control performance_date" id="e_date" placeholder="Enter date" required autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 mt7" for="e_instrument">Instruments</label>
                <div class="col-md-9 mb5">
                  <select class="form-control" name="e_instrument" required id="e_instrument">
                    <option value="">Select</option>
                    <option value="Forex">Forex</option>
                    <option value="Commodities">Commodities</option>
                    <option value="Index">Index</option>
                  </select>
                </div>
              </div>   

              <div class="form-group">
                <label class="col-md-3 mt7" for="e_lot_size">Lot size</label>
                <div class="col-md-9 mb5">
                  <input type="number" name="e_lot_size" class="form-control" id="e_lot_size" step="0.01" placeholder="Enter Lot size" required>
                </div>
              </div>       

              <div class="form-group">
                <label class="col-md-3 mt7" for="pip">Pips</label>
                <div class="col-md-9 mb5">
                  <input type="number" name="e_pip" class="form-control" id="pip" step="0.01" placeholder="Enter pips" required>
                </div>
              </div>           

              <div class="form-group">
                <label class="col-md-3 mt7" for="e_profit">Profit</label>
                <div class="col-md-9 mb5">
                  <input type="number" name="e_profit" class="form-control" id="e_profit" step="0.01" placeholder="Enter profit" required>
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