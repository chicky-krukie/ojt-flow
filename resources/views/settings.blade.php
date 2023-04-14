@extends('layout')
@section('content')
    <div class="col-lg-12">
        <h2 class="my-4">Settings</h2>
        <hr>
        <!-- This is the Form -->
        <form class="row" action="{{ route('settings', $settings['id']) }}" method="post">
            @csrf
            <div class="col-lg-6">
                <div class="my-4">
                    <p><b>Payment Methods </b></p>
                    <select name="payment_methods" class="form-control">
                        <option value="" disabled selected hidden>Enter your mode of payment</option>
                        @foreach ($settings['payment_methods'] as $settingMethods)
                            <option value="{{ $settingMethods['method'] }}">{{ $settingMethods['method'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-4">
                    <p><b>Payment Status </b></p>
                    <select name="payment_status" class="form-control">
                        <option value="" disabled selected hidden>Enter the status of your payment</option>
                        @foreach ($settings['payment_status'] as $settingStatus)
                            <option value="{{ $settingStatus['status'] }}">{{ $settingStatus['status'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="my-4">
                    <p><b>Multiplier default</b></p>
                    <input name="multiplier_default" class="form-control" value="{{ $settings['multiplier_default'] }}">
                </div>

                <div class="my-4">
                    <p><b>Multiplier Cost</b></p>
                    <input name="multiplier_cost" class="form-control" placeholder="Your Multiplier cost is.."
                        value="{{ $settings['multiplier_cost'] }}">
                </div>

                <div class="my-4">
                    <!-- It shows the value of the card/inventory not the currency -->
                    <h5><b>Currency</b></h5>
                    <p>TCG Low</p>

                    <input name="tcg_low" class="form-control" placeholder="Your cost is.."
                        value="{{ $settings['currency']['tcg_low'] }}">
                    <p>TCG Mid</p>

                    <input name="tcg_mid" class="form-control" placeholder="Your cost is.."
                        value="{{ $settings['currency']['tcg_mid'] }}">
                    <p>TCG High</p>

                    <input name="tcg_high" class="form-control" placeholder="Your cost is.."
                        value="{{ $settings['currency']['tcg_high'] }}">

                </div>
                <div class="my-4">
                    <p><b>Sold Price</b></p>
                    <input name="sold_price" class="form-control" placeholder="Your cost is.."
                        value="{{ $settings['currency']['sold_price'] }}">
                </div>
                <div class="my-4">
                    <p><b>Estimated Card Cost</b></p>
                    <input name="estimated_card_cost" class="form-control" placeholder="Your cost is.."
                        value="{{ $settings['currency']['estimated_card_cost'] }}">
                </div>
                <div class="my-4">
                    <p><b>Shipment Cost</b></p>
                    <input name="ship_cost" class="form-control" placeholder="Your cost is.."
                        value="{{ $settings['currency']['ship_cost'] }}">
                    </select>
                </div>
                <div class="my-4">
                    <p><b>Shipment Price</b></p>
                    <input name="ship_price" class="form-control" placeholder="Your cost is.."
                        value="{{ $settings['currency']['ship_price'] }}">
                </div>

                <button class="btn btn-primary" type="submit">Save Changes</button>




            </div>


        </form>


    </div>
    </div>
@endsection
