{{-- Table --}}
<div class="container-fluid px-5">
    @if (isset($inventories) && count($inventories) > 0)
        <div class="table-responsive-md">
            <button class="btn btn-danger btn-sm my-4 delete_all" data-url="{{ route('delete-selected-inventory') }}">Bulk
                Delete</button>
            <table class="table table-sm table-hover bg-white" id="ojt_flow">
                <thead class="bg-light table-group-divider table-divider-color">
                    <tr class="tr-background">
                        <th scope="col" class="text-center width-50"><input type="checkbox" id="selector">
                        </th>
                        <th scope="col" class="text-center width-200">Thumbnail</th>
                        <th scope="col" class="text-center width-200">Name</th>
                        <th scope="col" class="text-center width-120">Color Identity</th>
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

                    {{-- Search --}}
                    <tr>
                        <td scope="col" class="text-center" style="opacity: 0"></td>
                        <td scope="col" class="text-center" style="opacity: 0">Thumbnail</td>
                        <td scope="col" class="text-center">Name</td>
                        <td scope="col" class="text-center width-120">Color Identity</td>
                        <td scope="col" class="text-center">Type</td>
                        <td scope="col" class="text-center">Frame Effects</td>
                        <td scope="col" class="text-center">Finish</td>
                        <td scope="col" class="text-center">Rarity</td>
                        <td scope="col" class="col-1 text-center"><a href="#sort" data-bs-toggle="modal"
                                style="text-decoration: none; color:black;">Quantity</a></td>
                        <td scope="col" class="text-center">TCG Mid</td>
                        <td scope="col" class="text-center">Total</td>
                        <td scope="col" class="text-center" style="opacity: 0"></td>
                    </tr>
                </thead>

                <tbody>
                    @if (is_array($inventories) && count($inventories))
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
                    @endif
                </tbody>
                <tfoot>

                </tfoot>
            </table>

        </div>
    @else
        <br>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 text-center p-5">
                    <img src="https://icon-library.com/images/no-data-icon/no-data-icon-0.jpg" alt=""
                        style="widows: 100px; height: 100px;">
                    <br>
                    <br>
                    <h1>No data found. Please insert a CSV file.</h1>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    var finish = 6;
    var rarity = 7;
    //Input Text and Dropdown
    $('#ojt_flow thead td').each(function(index) {
        if (index === 6) {
            var title = "Finish";
            $(this).html('<select><option value="">' + title +
                '</option><option value="' + "Normal" +
                '">Normal</option><option value="' + "Foil" +
                '">Foil</option></select>'
            );
        } else if (index === 7) {
            var title = "Rarity";
            $(this).html('<select><option value="">' + title +
                '</option><option value="' + "uncommon" +
                '">Uncommon</option><option value="' + "rare" +
                '">Rare</option><option value="' + "mythic" +
                '">Mythic</option></select>'
            );
        } else {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" />');
        }
    });

    // DataTable
    var table = $('#ojt_flow').DataTable({
        lengthMenu: [50, 100, 200, 500],
        scrollY: '55vh',
        scrollCollapse: true,
        stateSave: true,
        "bFilter": false

    });


    // Apply the search
    table.columns().eq(0).each(function(colIdx) {
        $('input, select', table.column(colIdx).header()).on('keyup change', function() {
            table
                .column(colIdx)
                .search(this.value)
                .draw();
        });
        $('input, select', table.column(colIdx).header()).on('click', function(e) {
            e.stopPropagation();
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#selector').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });

        $('.delete_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if (allVals.length <= 0) {
                alert("Please Select Row");
            } else {
                var check = confirm("Are you sure you want to delete this row? ");
                if (check == true) {
                    var selected = allVals.join(",");
                    $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + selected,
                            success: function(data) {
                                if (data['success']) {

                                    location.reload()
                                }
                            },
                            error: function(data) {
                                alert(data.responseText);

                            }
                        }),

                        $.each(allVals, function(inventories, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });

                }
            }


        });

    });
</script>


@push('scripts')
    <script>
        $(document).on('change', '.quantity', function(event) {
            if (event.target === this) {
                var row = $(this).closest('.product_row')
                var tcg_mid = row.find('.tcg_mid').val().trim().replace('$', '')
                var multiplier = row.find('.multiplier').val()
                var quantity = $(this).val()
                var sold = (parseFloat(tcg_mid) * parseFloat(multiplier)) * quantity;
                row.find('.sold').val(sold.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                }))

            }
        })

        $(document).on('change', '.multiplier', function(event) {
            if (event.target === this) {
                var row = $(this).closest('.product_row')
                var multiplier = $(this).val()
                var tcg_mid = row.find('.tcg_mid').val().trim().replace('$', '')
                var multiplied_price = (parseFloat(tcg_mid) * parseFloat(multiplier))
                row.find('.multiplied_price').val(multiplied_price.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                }));

                var quantity = row.find('.quantity').val()
                var sold = (parseFloat(tcg_mid) * parseFloat(multiplier)) * quantity;
                row.find('.sold').val(sold.toLocaleString(undefined, {
                    manimumFractionDigits: 2,
                    maximumFractionDigits: 2,

                }))

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
