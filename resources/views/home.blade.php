@extends('layout')
@section('pageTitle','Home Page')
@section('content')
@foreach ($settings['payment_methods'] as $method)
    <li>{{ $method['method'] }}</li>
@endforeach
    

@endsection