<div class="modal fade" id="addCurrency" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Currency</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('add-currency') }}" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <strong>Currency Name</strong>
                <input type="text" name="currency_name" class="form-control" placeholder="Currency Name">
            </div>
            <div class="mb-3">
                <strong>Currency Symbol</strong>
                <input type="text" name="symbol" class="form-control" placeholder="Currency Symbol">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>


    </div>
  </div>
</div>