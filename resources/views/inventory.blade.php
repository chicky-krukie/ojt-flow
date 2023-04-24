@extends('layout')
@section('pageTitle', 'Inventory')
@section('content')
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
                    <div class="col-auto">
                        <button class="btn btn-success" data-bs-target="#cache" data-bs-toggle="modal"
                            data-bs-placement="top" title="Upload CSV">Counter<i class="fa fa-th ml-2"></i></button>
                        @include('action-popUp.cache')
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
    </div>

    @include('table.inventoryTable')

@endsection




