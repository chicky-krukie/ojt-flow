@extends('layout')
@section('pageTitle', 'Orders')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Orders</h1>
        </div>
        <div class="row">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr >
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
                            <th scope="col">Action</th>
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
                                <td>{{ $order->tcg_mid }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>{{ $order->sold_price }}</td>
                                <td>{{ $order->ship_cost }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td class="">
                                    <button type="button" class="btn btn-primary btn-sm w-100 mb-1">update</button>
                                    <button type="button" class="btn btn-danger btn-sm w-100">delete</button>
                                </td>
                            </tr>
                        @endforeach
        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
