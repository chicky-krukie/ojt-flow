@extends('layout')
@section('content')

<div class="col-lg-12">
    <h2 class="my-4">Settings</h2>
    <hr>

    <form class="row">
        <div class="col-lg-6">
            <div class="my-4">
                <p><b>Payment Methods </b></p>
                <select class="form-control">
                    <option value="gcash">Gcash</option>
                    <option value="bank">Bank</option>
                    <option value="cash">Cash</option>
                </select>
            </div>

            <div class="my-4">
                <p><b>Payment Status </b></p>
                <select class="form-control">>
                    <option value="gcash">Paid</option>
                    <option value="bank">Unpaid</option>
                    <option value="cash">Reserved</option>
                </select>
            </div>

            <div class="my-4">
                <p><b>Multiplier default</b></p>
                <input class="form-control" value="50">
            </div>

            <div class="my-4">
                <p><b>Multiplier Cost</b></p>
                <input class="form-control" value="0">
            </div>

            <div class="my-4">
                <p><b>Currency (USD)</b></p>
                <select class="form-control">
                    <option value="gcash">TCG LOW</option>
                    <option value="bank">TCG MID</option>
                    <option value="cash">TCG HIGH</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        
    </form>

        
    </div>
</div>


@endsection