@extends('layout')
@section('pageTitle', 'Inventory')
@section('content')
    @php
        // Check if the file is still in JSON format
        function is_valid_json($raw_json)
        {
            $decoded = json_decode($raw_json, true);
            if ($decoded == null || is_int($decoded)) {
                return $raw_json;
            } else {
                $result = '';
                foreach ($decoded as $key => $value) {
                    $result .= '<br>' . '<b>' . $key . '</b>' . ': ' . $value;
                }
                print_r($result);
            }
        }
    @endphp
    <br>
    <div class="container-fluid px-5">
        <div class="col-auto">
            <div class="d-flex justify-content-between">
                <h2>Inventory</h2>
                <div class="d-flex">
                    <div class="col-auto">
                        {{-- Upload CSV --}}
                        <button class="btn btn-success" data-bs-target="#upload" data-bs-toggle="modal" data-bs-placement="top"
                            title="Upload CSV">Upload File<i class="fa fa-upload ml-2"></i></button>
                        @include('action-popUp.upload')
                    </div>
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Filter
                        </a>

                        <form action="{{ route('filterInventory') }}" class="dropdown-menu">
                            <button class="dropdown-item" value="default" name="filter" type="submit">Default</button>
                            <button class="dropdown-item" value="all" name="filter" type="submit">Show All</button>
                            <button class="dropdown-item" value="zero" name="filter" type="submit">Zero
                                Quantity</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Error handler for file import --}}
            @if ($errors->any())
                <div class="alert alert-danger form-control w-75 mx-auto">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <div class="note note-danger mb-3 text-center">
                            <strong>{{ $error[0] }}:</strong> {{ $error[1] }}
                        </div>
                    @endforeach
                </div>
            @endif
            <br>

        </div>

        <br>
    </div>
    </div>

    @include('table.inventoryTable')

@endsection
