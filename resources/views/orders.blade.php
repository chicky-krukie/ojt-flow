@php


    $totalQty = 0;
    function toInt($qty, &$totalQty){
        $strToInt = intval($qty);
        $totalQty += $strToInt;
        return $strToInt;
    }

    $totalTCG = 0;
    function toFloatTCG($tcg, &$totalTCG){
        $floatNumber = floatval(str_replace('$', '', $tcg));
        $totalTCG += $floatNumber;
        return '$'. $floatNumber;
    }

    $totalSoldPrc = 0;
    function toFloatPhp($soldPrc, &$totalSoldPrc){
        $floatNumber = floatval(str_replace('₱', '', $soldPrc));
        $totalSoldPrc += $floatNumber;
        return $floatNumber.' Php';
    }

    $totalShip = 0;
    function toFloatShip($ship, &$totalShip){
        $floatNumber = floatval(str_replace('Php', '', $ship));
        $totalShip += $floatNumber;
        return $floatNumber.' Php';
    }




@endphp


@extends('layout')
@section('pageTitle', 'Orders')
@section('content')


   


    <div class="col-lg-10 mx-auto">
        <h1 class="my-4">Orders</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col" >Selector</th>
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
                    <th><input type="checkbox"></th>
                    <td>{{ $order->sold_date }}</td>
                    <td>{{ $order->sold_to }}</td>
                    <td>{{ $order->card_name }}</td>
                    <td>{{ $order->set }}</td>
                    <td>{{ $order->finish }}</td>
                    <td>{{ toFloatTCG($order->tcg_mid, $totalTCG) }}</td>
                    <td>{{ toInt($order->qty, $totalQty) }}</td>
                    <td>{{ toFloatPhp($order->sold_price, $totalSoldPrc) }}</td>
                    <td>{{ toFloatShip($order->ship_cost, $totalShip) }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td class="">
                        <button class="btn" data-toggle="modal" data-target="{{ '#edit-order'.$order->id }}"><i class='fa fa-pencil'></i></button>
                        <button class="btn" data-toggle="modal" data-target="{{'#order'.$order->id}}"><i class='fa fa-trash'></i></button>
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
                <td><b>{{ '$'.$totalTCG }}</b></td>
                <td><b>{{ $totalQty }}</b></td>
                <td><b>{{ $totalSoldPrc.' Php' }}</b></td>
                <td><b>{{ $totalShip.' Php' }}</b></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection