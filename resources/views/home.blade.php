@extends('layout')
@section('pageTitle', 'Home Page')
@section('content')
    @foreach ($settings['payment_methods'] as $method)
        {{-- <li>{{ $method['method'] }}</li> --}}
    @endforeach


@endsection


<table>
    <thead>
        <tr>
            <th>Select</th>
            <th>Item Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="checkbox" class="select-row"></td>
            <td>Item 1</td>
            <td>$10</td>
        </tr>
        <tr>
            <td><input type="checkbox" class="select-row"></td>
            <td>Item 2</td>
            <td>$20</td>
        </tr>
        <tr>
            <td><input type="checkbox" class="select-row"></td>
            <td>Item 3</td>
            <td>$30</td>
        </tr>
        <tr>
            <td><input type="checkbox" class="select-row"></td>
            <td>Item 3</td>
            <td>$30</td>
        </tr>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Add click event to checkbox input
        $('.select-row').click(function() {
            // Toggle 'selected' class on parent row element
            $(this).closest('tr').toggleClass('selected');
        });
    });
</script>

<style>
    .selected {
        background-color: red;
    }
</style>
