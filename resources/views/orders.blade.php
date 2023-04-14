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
        $floatNumber = floatval(str_replace('Php', '', $soldPrc));
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


    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Delete</button>
            </div>
            </div>
        </div>
    </div>


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
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="{{ route('delete', ['id' => $order->id]) }}" data-id="{{ $order->id }}" >Delete</a>
                            </div>
                        </div>
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