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

            <form action="{{ route('edit-order', $order->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Payment Status</strong>
                        <select name="payment_status" class="form-control">
                        @foreach ($settings['status'] as $settingStatus)
                            <option value="{{ $settingStatus['id'] }}" @if (intval($order->payment_status) === $settingStatus['id']) selected @endif>{{ $settingStatus['status'] }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>