@php
    
    $totalQty = 0;
    function toInt($qty, &$totalQty)
    {
        $strToInt = intval($qty);
        $totalQty += $strToInt;
        return $strToInt;
    }
    
    $totalTCG = 0;
    function toFloatTCG($tcg, &$totalTCG, $settings)
    {
        $floatNumber = floatval(str_replace('$', '', $tcg));
        $totalTCG += $floatNumber;
    
        foreach ($settings['currency_option'] as $currency) {
            if ($settings['tcg_mid'] === $currency['id']) {
                return $currency['symbol'] . $floatNumber;
            }
        }
    }
    
    $totalSoldPrc = 0;
    function toFloatSoldPrc($soldPrc, &$totalSoldPrc, $settings)
    {
        $floatNumber = $soldPrc;
        $totalSoldPrc += $floatNumber;
    
        foreach ($settings['currency_option'] as $currency) {
            if ($settings['sold_price'] === $currency['id']) {
                return $currency['symbol'] . $floatNumber;
            }
        }
    }
    
    $totalShip = 0;
    function toFloatShip($ship, &$totalShip, $settings)
    {
        $floatNumber = $ship;
        $totalShip += $floatNumber;
    
        foreach ($settings['currency_option'] as $currency) {
            if ($settings['ship_cost'] === $currency['id']) {
                return $currency['symbol'] . $floatNumber;
            }
        }
    }
    
@endphp

@extends('layout')
@section('pageTitle', 'Orders')
@section('content')


    <div class="col-lg-10 mx-auto">
        <h1 class="my-4">Orders</h1>

        <table class="table" id='order-table'>
            <thead>
                <tr>
                    <th scope="col">Selector</th>
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
                    <th scope="col"></th>
                </tr>
            </thead>


            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th><input data-id="{{ $order->id }}" class="orderCheckbox" type="checkbox"></th>
                        <td>{{ $order->sold_date }}</td>
                        <td>{{ $order->sold_to }}</td>
                        <td>{{ $order->card_name }}</td>
                        <td>{{ $order->set }}</td>
                        <td>{{ $order->finish }}</td>
                        <td>{{ toFloatTCG($order->tcg_mid, $totalTCG, $settings) }}</td>
                        <td>{{ toInt($order->qty, $totalQty) }}</td>
                        <td>{{ toFloatSoldPrc($order->sold_price, $totalSoldPrc, $settings) }}</td>
                        <td>{{ toFloatShip($order->ship_cost, $totalShip, $settings) }}
                        </td>
                        <td>
                            @foreach ($settings['status'] as $status)
                                @if (intval($order->payment_status) === $status['id'])
                                    {{ $status['status'] }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $order->payment_method }}</td>
                        <td class="">
                            <button class="btn" data-toggle="modal" data-target="{{ '#edit-order' . $order->id }}"><i
                                    class='fa fa-pencil'></i></button>
                            <button class="btn" data-toggle="modal" data-target="{{ '#order' . $order->id }}"><i
                                    class='fa fa-trash'></i></button>
                            @include('order-modals.delete-modal')
                            @include('order-modals.edit-modal')
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>
                            @foreach ($settings['currency_option'] as $currency)
                                @if ($settings['tcg_mid'] === $currency['id'])
                                    {{ $currency['symbol'] . $totalTCG }}
                                @endif
                            @endforeach
                        </b></td>
                    <td><b>{{ $totalQty }}</b></td>
                    <td><b>
                            @foreach ($settings['currency_option'] as $currency)
                                @if ($settings['sold_price'] === $currency['id'])
                                    {{ $currency['symbol'] . $totalSoldPrc }}
                                @endif
                            @endforeach
                        </b></td>
                    <td><b>
                            @foreach ($settings['currency_option'] as $currency)
                                @if ($settings['ship_cost'] === $currency['id'])
                                    {{ $currency['symbol'] . $totalShip }}
                                @endif
                            @endforeach
                        </b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>


    <script>
        $('#order-table').DataTable({
            "lengthMenu": [50, 100, 200, 500],
            scrollY: 500,
            stateSave: true,
        });
    </script>
@endsection
