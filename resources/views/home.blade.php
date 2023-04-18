@extends('layout')
@section('pageTitle', 'Home Page')
@section('content')
  
    <br>
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            {{-- Upload CSV --}}
            <div class="">
                <form action="{{ route('importProductFromExcel') }}" class="row justify-content-center" accept-charset="utf-8"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="file" name="file" id="importFile" class="form-control col-8 w-75 mr-2">
                    <button type="submit" id="submit" class="btn btn-success col-2 w-auto ">Import CSV</button>
                </form>
            </div>
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror



        </div>

        <br>

    </div>
    {{-- Table --}}
    <div class="container-fluid px-5">
        @if (!empty($inventories) && count($inventories) > 0)
            <div class="table-responsive-md">
                <table class="table table-hover">
                    <thead>
                        <tr class="">
                            <th class="col-1">Selector</th>
                            <th class="">Thumbnail</th>
                            <th>Name</th>
                            <th>Color Identity</th>
                            <th>Type</th>
                            <th>Frame Effects</th>
                            <th>Finish</th>
                            <th>Rarity</th>
                            <th>Quantity</th>
                            <th>TCG Mid</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $item)
                            <tr class="">
                                <td><input type="checkbox" name="checkbox" id="checkbox"></td>

                                {{-- Get art_crop and normal image link --}}

                                <td>
                                    <img src="{{ $item['product']['art_crop'] }}" alt="{{ $item['product']['name'] }}" class="thumbnail"
                                        onmouseenter="this.src='{{ $item['product']['normal'] }}'"
                                        onmouseleave="this.src='{{ $item['product']['art_crop'] }}'">
                                </td>

                                <td>{{ $item['product']['name'] }}</td>
                                <td>{{ $item['product']['color_identity'] }}</td>
                                <td>{{ $item['product']['type_line'] }}</td>
                                <td>{{ $item['product']['frame_effects'] }}</td>
                                <td>{{ $item['printing'] }}</td>
                                <td>{{ $item['product']['rarity']}}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td class="editable" contenteditable="true">{{ $item['price_each'] }}
                                </td>
                                <td>
                                    ${{ floatval($item['quantity']) * floatval(preg_replace('/[^-0-9\.]/', '', $item['price_each'])) }}
                                </td>

                                {{-- Action Column --}}
                                <td class="">
                                    <a href="#view{{ $item['id'] }}" data-bs-toggle="modal"
                                        class="btn btn-primary mb-1 form-control"><i class="fa fa-info"></i>
                                        View</a>
                                    <br>
                                    <a href="#edit{{ $item['id'] }}" data-bs-toggle="modal"
                                        class="btn btn-success mb-1 form-control"><i class='fa fa-shopping-cart'></i>
                                        Sold</a>
                                    <br>
                                    <a href="#delete{{ $item['id'] }}" data-bs-toggle="modal"
                                        class="btn btn-danger form-control"><i class='fa fa-trash'></i> Delete</a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <br>
            <h1 class="text-center">There is NO DATA</h1>
        @endif
    </div>



@endsection
