<!-- Modal -->
<div class="modal fade" id="{{'edit-order'.$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Orders</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <strong>TCGPLAYER ID</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
                <div class="mb-3">
                    <strong>Quantity</strong>
                    <input type="number" name="quantity" class="form-control" placeholder="quantity" value="1" min="1" max="10">
                </div>

                <div class="mb-3">
                    <strong>Sold Price (Peso):</strong>
                    <input type="text" name="sold" class="form-control">
                </div>

                <div class="mb-3">
                    <strong>Ship price:</strong>
                    <input type="text" name="ship_price" class="form-control" placeholder="">
                </div>

                <div class="mb-3">
                    <strong>Ship cost:</strong>
                    <input type="text" name="ship_cost" class="form-control" placeholder="">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>