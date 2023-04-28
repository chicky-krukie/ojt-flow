<?php

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CurrencyController;

//Display Inventory Table
Route::get('/inventoryTable', [InventoryController::class, 'inventoryTable'])->name('inventoryTable');

//Import CSV file
Route::post('/importProduct', [InventoryController::class, 'importCsv'])->name('importProductFromCsv');;

//Sort Quantity
Route::get('/inventory', [InventoryController::class, 'sortQuantity'])->name('sortQuantity');

//Filter Inventory Row
Route::get('/filter', [InventoryController::class, 'filterInventory'])->name('filterInventory');

//Increment Quantity
Route::put('/increment/{id}', [InventoryController::class, 'up'])->name('quantity.up');

//Decrement Quantity
Route::put('/decrement/{id}', [InventoryController::class, 'down'])->name('quantity.down');

//Inline Edit price_each (TCG Mid)
Route::put('/edit/{id}', [InventoryController::class, 'edit'])->name('price_each.edit');

//Selected Delete Inventory
Route::delete('/delete-selected-inventory', [InventoryController::class, 'deleteSelectInventory'])->name('delete-selected-inventory');



Route::get('/orders', [OrderController::class, 'orders'])->name('orders');

Route::match(['post', 'get'], '/settings/{id?}', [SettingsController::class, 'settings'])->name('settings');

Route::post('/update/{id}', [InventoryController::class, 'sold'])->name('csv.update');
Route::post('/delete/{id}', [InventoryController::class, 'delete'])->name('csv.delete');

Route::get('/', [HomeController::class, 'home'])->name('home');



Route::get('/delete-order/{tcgplacer_id}/{id}', [OrderController::class, 'returnOrder'])->name('delete-order');
Route::post('/edit-order/{id}', [OrderController::class, 'editOrder'])->name('edit-order');
Route::delete('/delete-selected-order', [OrderController::class, 'deleteSelectOrder'])->name('delete-selected-order');

Route::post('/import-product-from-excel', [HomeController::class, 'importProductFromExcel'])->name('importProductFromExcel');

// settings
Route::post('/add-currency', [CurrencyController::class, 'addCurrency'])->name('add-currency');
Route::post('/add-method', [CurrencyController::class, 'addMethod'])->name('add-method');
