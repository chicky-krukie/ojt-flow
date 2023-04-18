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
                    @foreach ($settings['method'] as $settingMethods)
                    <option value="{{ $settingMethods['id'] }}" 
                    @if ($settings['payment_methods']['id'] === $settingMethods['id']) 
                     selected 
                    @endif>{{ $settingMethods['method'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-4">
                <p><b>Payment Status </b></p>
                <select name="payment_status" class="form-control">
                    @foreach ($settings['status'] as $settingStatus)
                    <option value="{{ $settingStatus['id'] }}" @if ($settings['payment_status']['id']===$settingStatus['id']) selected @endif>{{ $settingStatus['status'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="my-4">
                <p><b>Multiplier default</b></p>
                <input name="multiplier_default" class="form-control" value="{{ $settings['multiplier_default'] }}">
            </div>

            <div class="my-4">
                <p><b>Multiplier Cost</b></p>
                <input name="multiplier_cost" class="form-control" placeholder="Your Multiplier cost is.." value="{{ $settings['multiplier_cost'] }}">
            </div>

            <div class="my-4">
                <!-- It shows the value of the card/inventory not the currency -->
                <h5><b>Currency</b></h5>
                <p>TCG Low</p>
                <select name="tcg_low" class="form-control">
                    @foreach ($settings['currency_option'] as $settingCurrency)
                    <option value="{{ $settingCurrency['id'] }}" @if ($settings['tcg_low']===$settingCurrency['id']) selected @endif>{{ $settingCurrency['symbol'] }}</option>
                    @endforeach
                </select>

                <p>TCG Mid</p>
                <select name="tcg_mid" class="form-control">
                    @foreach ($settings['currency_option'] as $settingCurrency)
                    <option value="{{ $settingCurrency['id'] }}" @if ($settings['tcg_mid']===$settingCurrency['id']) selected @endif>{{ $settingCurrency['symbol'] }}</option>
                    @endforeach
                </select>

                <p>TCG High</p>
                <select name="tcg_high" class="form-control">
                    @foreach ($settings['currency_option'] as $settingCurrency)
                    <option value="{{ $settingCurrency['id'] }}" @if ($settings['tcg_high']===$settingCurrency['id']) selected @endif>{{ $settingCurrency['symbol'] }}</option>
                    @endforeach
                </select>

            </div>
            <div class="my-4">
                <p><b>Sold Price</b></p>
                <select name="sold_price" class="form-control">
                    @foreach ($settings['currency_option'] as $settingCurrency)
                    <option value="{{ $settingCurrency['id'] }}" @if ($settings['sold_price']===$settingCurrency['id']) selected @endif>{{ $settingCurrency['symbol'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-4">
                <p><b>Estimated Card Cost</b></p>
                <select name="estimated_card_cost" class="form-control">
                    @foreach ($settings['currency_option'] as $settingCurrency)
                    <option value="{{ $settingCurrency['id'] }}" @if ($settings['estimated_card_cost']===$settingCurrency['id']) selected @endif>{{ $settingCurrency['symbol'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-4">
                <p><b>Shipment Cost</b></p>
                <select name="ship_cost" class="form-control">
                    @foreach ($settings['currency_option'] as $settingCurrency)
                    <option value="{{ $settingCurrency['id'] }}" @if ($settings['ship_cost']===$settingCurrency['id']) selected @endif>{{ $settingCurrency['symbol'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-4">
                <p><b>Shipment Price</b></p>
                <select name="ship_price" class="form-control">
                    @foreach ($settings['currency_option'] as $settingCurrency)
                    <option value="{{ $settingCurrency['id'] }}" @if ($settings['ship_price']===$settingCurrency['id']) selected @endif>{{ $settingCurrency['symbol'] }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary" type="submit">Save Changes</button>




        </div>


    </form>


</div>
</div>
@endsection