@extends('layout')
@section('pageTitle', 'Inventory')
@section('content')
    <br>
    <div class="container">
        <div class="row">
            {{-- Upload CSV --}}
            <div class="">
                <form action="{{ route('importProductFromCsv') }}" class="row justify-content-center" accept-charset="utf-8"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="file" name="file" id="importFile" class="form-control col-8 w-75 mr-2">
                    <button type="submit" id="submit" class="btn btn-success col-2 w-auto ">Import CSV</button>
                </form>
                @if (Cache::get('csv_import_progress') !== null)
                   
                    <p>Rows processed: {{ Cache::get('csv_import_progress')['processed'] }}</p>
                    <p>Total time: {{ Cache::get('totalTime')}} </p>
                @endif
            </div>

            {{-- Error handler for file import --}}
            @if ($errors->any())
                <div class="alert alert-danger form-control">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
