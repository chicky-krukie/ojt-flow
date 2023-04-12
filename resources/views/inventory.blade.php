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
@section('content')
    <div class="container">
        <div class="row">
            {{-- Upload CSV --}}
            <div class="col-10">
                <form action="{{ url('importProduct') }}" class="row" accept-charset="utf-8" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <input type="file" name="file" id="importFile" class="form-control col-auto w-50">
                    <button type="submit" id="submit" class="btn btn-success col-auto">Import CSV</button>
                </form>
            </div>
        </div>
        
        {{-- Table --}}
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <th>
                    <td>Selector</td>
                    <td>Name</td>
                    <td>Color Identity</td>
                    <td>Type</td>
                    <td>Frame Effects</td>
                    <td>Finish</td>
                    <td>Rarity</td>
                    <td>Quantity</td>
                    <td>TCG Mid</td>
                    <td>Total</td>
                    <td>Action</td>
                    </th>
                    @if (isset($inventories) && $inventories->count() > 0)
                        @foreach ($inventories as $item)
                            @php
                                $storage = $loop->iteration;
                            @endphp
                            <tr>
                                <td></td>
                                <td><input type="checkbox" name="checkbox" id="checkbox"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->color_identity }}</td>
                                <td>{{ $item->type_line }}</td>
                                <td>{{ $item->frame }}</td>
                                <td>{{ $item->finishes }}</td>
                                <td>{{ $item->rarity }}</td>
                                @foreach ($csv_outputs as $data)
                                    @if ($storage == $data->id)
                                        <td>{{ $data->quantity }}</td>
                                        <td>{{ $data->price_each }}</td>
                                        <td>${{ floatval($data->quantity) * floatval(preg_replace("/[^-0-9\.]/","",$data->price_each)) }}</td>
                                    @endif
                                @endforeach
                                <td>Action</td>
                            </tr>
                        @endforeach
                </table>
            </div>
        @else
            <h1>There is NO DATA</h1>
            @endif
        </div>
    </div>
@endsection
