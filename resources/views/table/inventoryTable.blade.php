        {{-- Table --}}
        <div class="container-fluid px-5">
            @if (isset($inventories) && $inventories->count() > 0)
                <div class="table-responsive-md">
                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th class="col-1">Selector</th>
                                <th class="">Thumbnail</th>
                                <th>Name</th>
                                <th>Color Identity</th>
                                <th>Type</th>
                                <th>Frame Effects</th>
                                <th>Finish</th>
                                <th>Rarity</th>
                                <th>Quantity</th>
                                <th>TCG Mid</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $index => $item)
                                @php
                                    $storage = $loop->iteration;
                                @endphp

                                <tr class="product_row">
                                    <td><input type="checkbox" name="checkbox" id="checkbox"></td>

                                    {{-- Get art_crop and normal image link --}}
                                    @php
                                        $image = json_decode($item->image_uris, true);
                                        $normalUri = $image['normal'];
                                        $artCropUri = $image['art_crop'];
                                    @endphp
                                    <td>
                                        <img src="{{ $artCropUri }}" alt="{{ $item->name }}" class="thumbnail"
                                            onmouseenter="this.src='{{ $normalUri }}'"
                                            onmouseleave="this.src='{{ $artCropUri }}'">
                                    </td>

                                    <td>{{ $item->name }}</td>

                                    {{-- Check if the color_identity is blank --}}
                                    @if ($item->color_identity == '[]')
                                        <td>land</td>
                                    @else
                                        <td>{{ is_valid_json($item->color_identity) }}</td>
                                    @endif

                                    <td>{{ $item->type_line }}</td>

                                    {{-- Check if the frame is blank --}}
                                    @if ($item->frame == '')
                                        <td>normal</td>
                                    @else
                                        <td>{{ $item->frame }}</td>
                                    @endif

                                    <td>{{ $csv_outputs[$index]->printing }}</td>
                                    <td>{{ $item->rarity }}</td>
                                    <td>{{ $csv_outputs[$index]->quantity }}</td>
                                    <td class="editable tcg_mid" contenteditable="true">
                                        {{ $csv_outputs[$index]->price_each }}
                                    </td>
                                    <td>
                                        ${{ $csv_outputs[$index]->total }}
                                    </td>

                                    {{-- Action Column --}}
                                    <td class="">
                                        <button data-bs-target="#view{{ $item->id }}" data-bs-toggle="modal"
                                            class="btn btn-primary mb-1 form-control"><i class="fa fa-info"></i>
                                            View</button>
                                        <br>
                                        <button data-bs-target="#edit{{ $item->uid }}" data-bs-toggle="modal"
                                            class="btn btn-success mb-1 form-control sold"
                                            data-item="{{ $item }}"><i class='fa fa-shopping-cart'></i>
                                            Sold</button>
                                        <br>
                                        <button data-bs-target="#delete{{ $item->uid }}" data-bs-toggle="modal"
                                            class="btn btn-danger form-control "><i class='fa fa-trash'></i>
                                            Delete</button>
                                        @include('action-popUp.action')
                                        @include('action-popUp.view')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <br>
                <h1 class="text-center">There is NO DATA</h1>
            @endif
        </div>

        @push('scripts')
            <script>

                $(document).on('change', '.quantity', function(event) {
                    if (event.target === this) {
                        var row = $(this).closest('.product_row')
                        var tcg_mid = row.find('.tcg_mid').text().trim().replace('$','');
                        var multiplier = row.find('.multiplier').val()
                        var quantity = $(this).val()
                        var sold = (parseFloat(tcg_mid)  * parseFloat(multiplier)) * quantity;
                        row.find('.sold').val(sold);

                    }
                })

                $(document).on('change', '.multiplier', function(event){
                    if(event.target === this){
                        var row = $(this).closest('.product_row')
                        var tcg_mid = row.find('.tcg_mid').text().trim().replace('$','');
                        var multiplier = row.find('.multiplier').val();
                        var multiplied_price = (parseFloat(tcg_mid) * parseFloat(multiplier))
                        row.find('.multiplied_price').val(multiplied_price)
                    }
                })



                $(document).on('blur', '.editable', function() {
                    var $cell = $(this);
                    var newValue = $cell.text();
                    var itemId = $cell.closest('tr').data('item-id');

                    $.ajax({
                        url: '/update-item-price/' + itemId,
                        type: 'PUT',
                        data: {
                            price: newValue
                        },
                        success: function(data) {
                            // handle successful response
                        },
                        error: function(xhr, status, error) {
                            // handle error response
                        }
                    });
                });
            </script>
        @endpush
