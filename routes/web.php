<?php

use App\Http\Controllers\InventoryController;
use App\Models\Inventory;
use Illuminate\Support\Facades\Route;

//Display Inventory Table
Route::get('/inventory', [InventoryController::class, 'inventoryTable'])->name('inventory');

//Import CSV file
Route::post('/importProduct', [InventoryController::class, 'importCsv']);

//StoreData from excel into database
Route::post('/storeCsv', [Inventory::class, 'storeCsv']);

Route::get('/orders', function () {
    return view('orders');
});

Route::get('/settings', function () {
    return view('settings');
});

Route::post('/update/{id}', [InventoryController::class, 'update'])->name('csv.update');
Route::post('/delete/{id}/{uid}', [InventoryController::class, 'delete'])->name('csv.delete');