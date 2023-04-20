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

        foreach($settings['currency_option'] as $currency)
        {
            if($settings['tcg_mid'] === $currency['id']){
                return $currency['symbol'].number_format($floatNumber, 2, '.', ',');
            }
        }
    }
    
    $totalSoldPrc = 0;
    function toFloatSoldPrc($soldPrc, &$totalSoldPrc, $settings){
        $floatNumber = floatval(str_replace(',', '', $soldPrc));
        $totalSoldPrc += $floatNumber;
        

        foreach($settings['currency_option'] as $currency)
        {
            if($settings['sold_price'] === $currency['id']){
                return $currency['symbol'].number_format($floatNumber, 2, '.', ',');
            }
        }


    }
    
    $totalShip = 0;
    function toFloatShip($ship, &$totalShip, $settings)
    {
        $floatNumber = $ship;
        $totalShip += $floatNumber;

        foreach($settings['currency_option'] as $currency)
        {
            if($settings['ship_cost'] === $currency['id']){
                return $currency['symbol'].number_format($floatNumber, 2, '.', ',');

            }
        }
    }
    
@endphp

@extends('layout')
@section('pageTitle', 'Orders')
@section('content')

<form method="post" action="{{ route('delete-selected-order') }}">
    @csrf
    <div class="mx-4">

        <h1 class="my-4">Orders</h1>

        <button type="submit" class="btn btn-danger btn-sm my-4">Bulk Delete</button>
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
                    <th><input name="order[]" value="{{ $order->id }}" type="checkbox"></th>
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
                        @foreach($settings['status'] as $status)
                        @if(intval($order->payment_status) === $status['id'])
                        {{ $status['status'] }}
                        @endif
                        @endforeach
                    </td>
                    <td>{{ $order->payment_method }}</td>
                    <td class="">
                        <button type="button" class="btn" data-toggle="modal" data-target="{{ '#edit-order'.$order->id }}"><i class='fa fa-pencil'></i></button>
                        <button type="button" class="btn" data-toggle="modal" data-target="{{'#order'.$order->id}}"><i class='fa fa-trash'></i></button>
                        @include('order-modals.delete-modal')
                        @include('order-modals.edit-modal')

                    </td>
                </tr>
                @endforeach
                <tr>
                    <th>Total</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>
                            @foreach($settings['currency_option'] as $currency)
                            @if($settings['tcg_mid'] === $currency['id'])
                            {{ $currency['symbol'].number_format($totalTCG, 2, '.', ',') }}
                            @endif
                            @endforeach
                        </b></td>
                    <td><b>{{ $totalQty }}</b></td>
                    <td><b>
                            @foreach($settings['currency_option'] as $currency)
                            @if($settings['sold_price'] === $currency['id'])
                            {{ $currency['symbol'].number_format($totalSoldPrc, 2, '.', ',') }}
                            @endif
                            @endforeach
                        </b></td>
                    <td><b>
                            @foreach($settings['currency_option'] as $currency)
                            @if($settings['ship_cost'] === $currency['id'])
                            {{ $currency['symbol'].number_format($totalShip, 2, '.', ',') }}
                            @endif
                            @endforeach
                        </b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</form>

<script>
    $('#order-table').DataTable({
        "lengthMenu": [50, 100, 200, 500],
    });


</script>
@endsection

