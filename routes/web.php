<?php

use App\Http\Controllers\SettingsController;
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

Route::post('/settings', [SettingsController::class, 'save'])->name('settings.update');

