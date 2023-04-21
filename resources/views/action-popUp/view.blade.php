<div class="modal fade" id="view{{ $item['id'] }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header align-middle">
                <h5 class="modal-title" id="myModalLabel">Card Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <img src="{{ $item['product']['art_crop'] }}" alt="{{ $item['product']['name'] }}"
                        class="text-center">
                </div>
                <h1 class="text-center my-1">{{ $item['product']['name'] }}</h1>
                <div class="mx-3">
                    <div class="d-flex justify-content-between mt-3">
                        <h6>Product ID:</h6>
                        <p><strong>{{ $item['product_id'] }}</strong></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Set Name:</h6>
                        <p><strong>{{ $item['product']['set_name'] }}</strong></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Type Line:</h6>
                        <p><strong>{{ $item['product']['type_line'] }}</strong></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Color Identity:</h6>
                        <p><strong>{{ $item['product']['color_identity'] }}</strong></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Finishes:</h6>
                        <p><strong>{{ $item['product']['finishes'] }}</strong></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Rarity:</h6>
                        <p><strong>{{ $item['product']['rarity'] }}</strong></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Frame Effects:</h6>
                        <p><strong>{{ $item['product']['frame_effects'] }}</strong></p>
                    </div>

                    {{-- BTN --}}
                    <div class="d-flex justify-content-center align-items-start mt-3">
                        <div class="">
                            <h4>Card Price: <strong>${{ $item['price_each'] }}</strong></h4>
                        </div>         
                            <span class="badge badge-primary rounded-pill ml-3">Quantity: {{ $item['quantity'] }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- <span class="badge badge-primary rounded-pill">14</span> --}}
