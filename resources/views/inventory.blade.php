@php
    // Check if the file is still in JSON format
    function is_valid_json($raw_json)
    {
        $decoded = json_decode($raw_json, true);
        if ($decoded == null || is_int($decoded)) {
            return $raw_json;
        } else {
            if (is_array($decoded) && array_keys($decoded) != range(0, count($decoded) - 1)) {
                $result = '';
                foreach ($decoded as $key => $value) {
                    $result .= '<b>' . $key . '</b>' . ': ' . stringify_value($value) . '<br>';
                }
                print_r($result);
            } else {
                print_r(stringify_value(reset($decoded)));
            }
        }
    }
    
    // Display image link
    function stringify_value($value)
    {
        if (is_array($value) || is_object($value)) {
            return json_encode($value);
        } elseif (filter_var($value, FILTER_VALIDATE_URL)) {
            $url_parts = parse_url($value);
            $path_parts = pathinfo($url_parts['path']);
            if (isset($path_parts['extension']) && in_array(strtolower($path_parts['extension']), ['jpg', 'jpeg', 'png', 'gif'])) {
                return '<img src="' . $value . '" style="height:100px; weight:100px">';
            }
        }
        return $value;
    }
    
@endphp
@extends('layout')
@section('pageTitle', 'Inventory')
@section('content')
    <br>
    <div class="container">
        <div class="row">
            {{-- Upload CSV --}}
            <div class="">
                <form action="{{ url('importProduct') }}" class="row justify-content-center" accept-charset="utf-8" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <input type="file" name="file" id="importFile" class="form-control col-8 w-75 mr-2">
                    <button type="submit" id="submit" class="btn btn-success col-2 w-auto ">Import CSV</button>
                </form>
            </div>

            {{-- Error handler for file import --}}
            @if ($errors->any())
                <div class="alert alert-danger form-control">
                    @foreach ($errors->all() as $error)
                        <div class="note note-danger mb-3">
                            <strong>{{ $error[0] }}:</strong> {{ $error[1] }}
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <br>

    </div>
    @include('table.inventoryTable')

@endsection
