@extends('layout')
@section('pageTitle', 'Inventory')
@section('content')

<br>
<div class="container-fluid px-5">
    <h2 class="mb-4">Inventory</h2>
    <div class="col-auto">

        <form id="importForm" action="{{ route('importProductFromCsv') }}" class="row justify-content-center" accept-charset="utf-8" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="file" name="file" id="importFile" class="form-control col-8 w-75 mr-2">
            <button type="submit" id="submit" class="btn btn-success col-2 w-auto ">Import CSV</button>
        </form>

        <div class="col-auto my-4">
            <p class="text-center m">Uploading file please wait...</p>
            <div class="progress">
                <div id="progress-bar" class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">25%</div>

            </div>
        </div>

        <br>
    </div>
</div>

@include('table.inventoryTable')


@endsection




