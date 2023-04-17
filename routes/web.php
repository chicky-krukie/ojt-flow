<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Display Inventory Table
Route::get('/inventory', [InventoryController::class, 'inventoryTable'])->name('inventory');

//Import CSV file
Route::post('/importProduct', [InventoryController::class, 'importCsv']);

//StoreData from excel into database
Route::post('/storeCsv', [Inventory::class, 'storeCsv']);

//Edit TCG Mid price
Route::post('/update', [InventoryController::class, 'update'])->name('update');

//Sort Quantity
Route::get('/inventory', [InventoryController::class, 'sortQuantity'])->name('sortQuantity');

Route::get('/orders', [OrderController::class, 'orders'])->name('orders');

Route::get('/settings', function () {
    return view('settings');
});

Route::post('/update/{id}', [InventoryController::class, 'update'])->name('csv.update');
Route::post('/delete/{id}/{uid}', [InventoryController::class, 'delete'])->name('csv.delete');

Route::get('/',[HomeController::class,'home'])->name('home');