<!-- Sold Modal -->
<div class="modal fade" id="edit{{$item->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Sold</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route ('csv.update', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- <div class="mb-3">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div> -->
                    <div class="mb-3">
                        <strong>Quantity</strong>
                        <input type="text" name="quantity" value="{{ $csv_outputs[$index]->quantity }}" class="form-control" placeholder="quantity">
                    </div>
                    <div class="mb-3">
                        <strong>Payment Method</strong>
                        <p>Gcash</p>
                    </div>
                    <div class="mb-3">
                        <strong>TCG MID:</strong>
                        <input type="text" name="price_each" value="{{ $csv_outputs[$index]->price_each }}" class="form-control" placeholder="note">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i>Sold</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete{{$item->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Row</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route ('csv.delete', ['id' => $csv_outputs[$index]->id,'uid' => $item->uid]) }}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="modal-body">

                    <h4 class="text-center">Are you sure you want to delete this row?</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>