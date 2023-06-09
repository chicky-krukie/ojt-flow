@extends('layout')
@section('pageTitle', 'Orders')
@section('content')



    <div class="mx-4">
        <h1 class="my-4">Orders</h1>

        <button class="btn btn-danger btn-sm my-4 delete_all" data-url="{{ route('delete-selected-order') }}">Bulk
            Delete</button>

        <table class="table" id='order-table'>
            <thead>
                <tr>
                    <th scope="col"><input type="checkbox" id="selector"></th>
                    <th scope="col">Sold Date</th>
                    <th scope="col">Sold To</th>
                    <th scope="col">Card Name</th>
                    <th scope="col">Set</th>
                    <th scope="col">Finish</th>
                    <th scope="col">TCG MID</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Sold Price</th>
                    <th scope="col">Ship Cost</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Note</th>
                    <th scope="col">Ship Price</th>
                    <th scope="col">TCG Player ID</th>
                    <th scope="col">Tracking Number</th>
                    <th scope="col">Multiplier</th>
                    <th scope="col">Multiplier Price</th>
                    <th scope="col">Product ID</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>

                @if ($orders->count())
                    @foreach ($orders as $order)
                        <tr id="tr_{{ $order->id }}">
                            <th><input class="sub_chk" data-id="{{ $order->id }}" type="checkbox"></th>
                            <td>{{ $order->sold_date }}</td>
                            <td>{{ $order->sold_to }}</td>
                            <td>{{ $order->card_name }}</td>
                            <td>{{ $order->set }}</td>
                            <td>{{ $order->finish }}</td>
                            <td>
                                @foreach ($settings['currency_option'] as $currency)
                                    @if ($settings['tcg_mid'] === $currency['id'])
                                        {{ $currency['symbol'] . number_format($order->tcg_mid, 2, '.', ',') }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $order->qty }}</td>
                            <td>
                                @foreach ($settings['currency_option'] as $currency)
                                    @if ($settings['sold_price'] === $currency['id'])
                                        {{ $currency['symbol'] . number_format($order->sold_price, 2, '.', ',') }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($settings['currency_option'] as $currency)
                                    @if ($settings['ship_cost'] === $currency['id'])
                                        {{ $currency['symbol'] . number_format($order->ship_cost, 2, '.', ',') }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($settings['status'] as $status)
                                    @if (intval($order->payment_status) === $status['id'])
                                        {{ $status['status'] }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->note }}</td>
                            <td>{{ $order->ship_price }}</td>
                            <td>{{ $order->tcgplacer_id }}</td>
                            <td>{{ $order->tracking_number }}</td>
                            <td>{{ $order->multiplier }}</td>
                            <td>{{ $order->multiplier_price }}</td>
                            <td>{{ $order->product_id }}</td>


                            <td class="">
                                <button type="button" class="btn" data-toggle="modal"
                                    data-target="{{ '#edit-order' . $order->id }}"><i class='fa fa-pencil'></i></button>
                                @include('order-modals.edit-modal')

                                <button type="button" class="btn" data-toggle="modal"
                                    data-target="{{ '#order' . $order->id }}"><i class='fa fa-undo'></i></button>
                                @include('order-modals.delete-modal')

                            </td>
                        </tr>
                    @endforeach
            <tfoot>
                <th>Total</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tfoot>
            @endif


            </tbody>
        </table>
    </div>



    <script>
        $('#order-table').DataTable({
            "lengthMenu": [50, 100, 200, 500],
            dom: 'Bfrtip',
            buttons: [
                'pageLength',
                'excelHtml5',
                {
                    extend: 'colvis',
                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
                    columnText: function(dt, idx, title) {
                        return (idx) + ': ' + title;
                    }
                }
            ],
            columnDefs: [{
                targets: [12, 13, 14, 15, 16, 17, 18],
                visible: false
            }],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$₱\,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                //columns
                var column6total = api
                    .column(6)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var column7total = api
                    .column(7)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var column8total = api
                    .column(8)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var column9total = api
                    .column(9)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);




                // footer column 6
                $(api.column(6).footer()).html(`<b>
            <?php
            foreach ($settings['currency_option'] as $currency):
                if ($settings['tcg_mid'] === $currency['id']):
                    echo $currency['symbol'];
                endif;
            endforeach;
            ?> 
            ${column6total.toLocaleString(undefined, {minimumFractionDigits: 2})}</b>`);

                // footer column 7
                $(api.column(7).footer()).html(`<b>${column7total}</b>`);

                // footer column 8
                $(api.column(8).footer()).html(`<b>
            <?php foreach ($settings['currency_option'] as $currency):
                if ($settings['sold_price'] === $currency['id']):
                    echo $currency['symbol'];
                endif;
            endforeach;
            ?> 
            ${column8total.toLocaleString(undefined, {minimumFractionDigits: 2})}</b>`);

                // footer column 9
                $(api.column(9).footer()).html(`
            <?php foreach ($settings['currency_option'] as $currency):
                if ($settings['ship_cost'] === $currency['id']):
                    echo $currency['symbol'];
                endif;
            endforeach; ?> 
            <b>${column9total.toLocaleString(undefined, {minimumFractionDigits: 2})}</b>`);
            }


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
                                $('table tr').filter("[data-row-id'" + value + "']").remove();
                            });
                    }
                }
            });
        });
    </script>

@endsection
