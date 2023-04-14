@extends('layout')
@section('content')

<div class="col-lg-12">
    <h2 class="my-4">Settings</h2>
    <hr>
    <!-- This is the Form -->
    <form class="row" action="{{route('settings.update')}}" method="post">
        @csrf

        <div class="col-lg-6">
            <div class="my-4">
                <p><b>Payment Methods </b></p>
                <select name="payment_methods" class="form-control">
                    <option value="" disabled selected hidden>Enter your mode of payment</option>
                    <option value="gcash">Gcash</option>
                    <option value="bank">Bank</option>
                    <option value="cash">Cash</option>
                </select>
            </div>
            <div class="my-4">
                <p><b>Payment Status </b></p>
                <select name="payment_status" class="form-control">
                    <option value="" disabled selected hidden>Enter the status of your payment</option>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="reserved">Reserved</option>
                </select>
            </div>

            <div class="my-4">
                <p><b>Multiplier default</b></p>
                <input name="multiplier_default" class="form-control" value="50">
            </div>

            <div class="my-4">
                <p><b>Multiplier Cost</b></p>
                <input name="multiplier_cost" class="form-control" placeholder="Your Multiplier cost is..">
            </div>

            <div class="my-4">
                <!-- It shows the value of the card/inventory not the currency -->
                <h5><b>Currency</b></h5>
                <p>TCG Status</p>
                <select name="tcg_status" class="form-control">
                                <option value="tcg_low">TCG LOW</option>
                                <option value="tcg_mid" selected>TCG MID</option>
                                <option value="tcg_high">TCG HIGH</option>
                            </select>

            </div>
            <div class="my-4">
                <p><b>Sold Price</b></p>
                <select name="sold_price" class="form-control">
                <option value="" disabled selected hidden>Enter your prefered currency</option>
                    <option value="₱">₱-Philippine Peso</option>
                    <option value="$">$-USD Dollar</option>
                </select>
            </div>
            <div class="my-4">
                <p><b>Estimated Card Cost</b></p>
                <select name="estimated_card_cost" class="form-control">
                <option value="" disabled selected hidden>Enter your prefered currency</option>
                    <option value="₱">₱-Philippine Peso</option>
                    <option value="$">$-USD Dollar</option>
                </select>
            </div>
            <div class="my-4">
                <p><b>Shipment Cost</b></p>
                <select name="shipment_cost" class="form-control">
                <option value="" disabled selected hidden>Enter your prefered currency</option>
                    <option value="₱">₱-Philippine Peso</option>
                    <option value="$">$-USD Dollar</option>
                </select>
            </div>
            <div class="my-4">
                <p><b>Shipment Price</b></p>
                <select name="shipment_price" class="form-control">
                <option value="" disabled selected hidden>Enter your prefered currency</option>
                    <option value="₱">₱-Philippine Peso</option>
                    <option value="$">$-USD Dollar</option>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">Save Changes</button>


            <!-- test -->
           

        </div>


    </form>


</div>
</div>


@endsection