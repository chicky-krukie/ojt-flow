        {{-- Table --}}
        <div class="container-fluid px-5">
            @if (isset($inventories) && count($inventories) > 0)
                <div class="table-responsive-md">
                    <table class="table table-hover" id="ojt_flow">
                        <thead>
                            <tr>
                                <th scope="col" class="col-1 text-center">Selector</th>
                                <th scope="col" class="text-center">Thumbnail</th>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Color Identity</th>
                                <th scope="col" class="text-center">Type</th>
                                <th scope="col" class="text-center">Frame Effects</th>
                                <th scope="col" class="text-center">Finish</th>
                                <th scope="col" class="text-center">Rarity</th>
                                <th scope="col" class="col-1 text-center"><a href="#sort" data-bs-toggle="modal"
                                        style="text-decoration: none; color:black;">Quantity</a></th>
                                <th scope="col" class="text-center">TCG Mid</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Action</th>
                                @include('action-popUp.sortQuantity')
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $item)
                                {{-- Quantity Sorting --}}
                                @if ($condition == '=')
                                    @if ($item['quantity'] == $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @elseif ($condition == '<')
                                    @if ($item['quantity'] < $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @elseif ($condition == '<=')
                                    @if ($item['quantity'] <= $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @elseif ($condition == '>')
                                    @if ($item['quantity'] > $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @elseif ($condition == '>=')
                                    @if ($item['quantity'] >= $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @else
                                    @include('sort-list.inventoryRow')
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <br>
                <h1 class="text-center">There is NO DATA</h1>
            @endif
        </div>
        <script>
            $('#ojt_flow').DataTable({
                "lengthMenu": [50, 100, 200, 500],
                scrollY: 580,
            })
        </script>


        @push('scripts')
            <script>
                $(document).on('change', '.quantity', function(event) {
                            if (event.target === this) {
                                var row = $(this).closest('.product_row')
                                var tcg_mid = row.find('.tcg_mid').val().trim().replace('$', '');
                                var multiplier = row.find('.multiplier').val()
                                var quantity = $(this).val()
                                var sold = (parseFloat(tcg_mid) * parseFloat(multiplier)) * quantity;
                                row.find('.sold').val(sold.toLocaleString(undefined, {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2,
                                    }));

                                }
                            })

                        $(document).on('change', '.multiplier', function(event) {
                            if (event.target === this) {
                                var row = $(this).closest('.product_row')
                                var tcg_mid = row.find('.tcg_mid').val().trim().replace('$', '');
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
