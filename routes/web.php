<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', function () {
    return view('orders');
});

Route::get('/settings', function () {
    return view('settings');
});