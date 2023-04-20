@extends('layout')
@section('content')
    <div class="col-6 mx-auto">
        <h2 class="my-4">Settings</h2>
        <hr>
        @include('settings-modals.add-currency')
        @include('settings-modals.add-methods')
        <!-- This is the Form -->
        <form class="row" action="{{ route('settings', $settings['id']) }}" method="post">
            @csrf
            <div class="col-lg-6">
                <div class="mt-4">
                    <div class="d-flex justify-content-between">
                        <p><b>Payment Methods </b></p>

                        <button class="btn btn-small btn-outline-secondary" type="button" data-toggle="modal"
                            data-target="#addMethod">Add</button>
                    </div>

                    <select name="payment_methods" class="form-control mt-1">
                        @foreach ($settings['method'] as $settingMethods)
                            <option value="{{ $settingMethods['id'] }}" @if ($settings['payment_methods']['id'] === $settingMethods['id']) selected @endif>
                                {{ $settingMethods['method'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <p class="mb-3"><b>Payment Status </b></p>
                    <select name="payment_status" class="form-control">
                        @foreach ($settings['status'] as $settingStatus)
                            <option value="{{ $settingStatus['id'] }}" @if ($settings['payment_status']['id'] === $settingStatus['id']) selected @endif>
                                {{ $settingStatus['status'] }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mt-4">
                    <p class="mb-3"><b>Multiplier default</b></p>
                    <input name="multiplier_default" class="form-control" value="{{ $settings['multiplier_default'] }}">
                </div>

                <div class="mt-4">
                    <p class="mb-3"><b>Multiplier Cost</b></p>
                    <input name="multiplier_cost" class="form-control" placeholder="Your Multiplier cost is.."
                        value="{{ $settings['multiplier_cost'] }}">
                </div>

            </div>

            <div class="col-lg-6 mt-3">
                <div class="mt-1">
                    <p style="margin-top: 10px; margin-bottom: 18px;"><b>Sold Price</b></p>
                    <select name="sold_price" class="form-control">
                        @foreach ($settings['currency_option'] as $settingCurrency)
                            <option value="{{ $settingCurrency['id'] }}" @if ($settings['sold_price'] === $settingCurrency['id']) selected @endif>
                                {{ $settingCurrency['symbol'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-4">
                    <p><b>Estimated Card Cost</b></p>
                    <select name="estimated_card_cost" class="form-control">
                        @foreach ($settings['currency_option'] as $settingCurrency)
                            <option value="{{ $settingCurrency['id'] }}" @if ($settings['estimated_card_cost'] === $settingCurrency['id']) selected @endif>
                                {{ $settingCurrency['symbol'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-4">
                    <p><b>Shipment Cost</b></p>
                    <select name="ship_cost" class="form-control">
                        @foreach ($settings['currency_option'] as $settingCurrency)
                            <option value="{{ $settingCurrency['id'] }}" @if ($settings['ship_cost'] === $settingCurrency['id']) selected @endif>
                                {{ $settingCurrency['symbol'] }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- save --}}
                <div class="my-4">
                    <p><b>Shipment Price</b></p>
                    <select name="ship_price" class="form-control">
                        @foreach ($settings['currency_option'] as $settingCurrency)
                            <option value="{{ $settingCurrency['id'] }}" @if ($settings['ship_price'] === $settingCurrency['id']) selected @endif>
                                {{ $settingCurrency['symbol'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Currency --}}
            <div class="mt-0">
                <!-- It shows the value of the card/inventory not the currency -->
                <div style="display:flex; justify-content: space-between">
                    <h5><b>Currency</b></h5>
                    <button class="btn btn-small btn-outline-secondary" type="button" data-toggle="modal"
                        data-target="#addCurrency">Add</button>
                </div>

                <div class="row align-items-start">
                    <div class="col">
                        <p>TCG Low</p>
                        <select name="tcg_low" class="form-control">
                            @foreach ($settings['currency_option'] as $settingCurrency)
                                <option value="{{ $settingCurrency['id'] }}"
                                    @if ($settings['tcg_low'] === $settingCurrency['id']) selected @endif>
                                    {{ $settingCurrency['symbol'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p>TCG Mid</p>
                        <select name="tcg_mid" class="form-control">
                            @foreach ($settings['currency_option'] as $settingCurrency)
                                <option value="{{ $settingCurrency['id'] }}"
                                    @if ($settings['tcg_mid'] === $settingCurrency['id']) selected @endif>
                                    {{ $settingCurrency['symbol'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p>TCG High</p>
                        <select name="tcg_high" class="form-control">
                            @foreach ($settings['currency_option'] as $settingCurrency)
                                <option value="{{ $settingCurrency['id'] }}"
                                    @if ($settings['tcg_high'] === $settingCurrency['id']) selected @endif>
                                    {{ $settingCurrency['symbol'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-secondary form-control" type="submit">Save Changes</button>
            </div>
    </div>

    </form>

    </div>

    </div>
@endsection
