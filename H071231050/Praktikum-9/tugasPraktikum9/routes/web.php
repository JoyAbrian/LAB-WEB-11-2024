<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('layouts/home');
    return redirect('/products');
});


Route::resource('/products', ProductController::class);
Route::resource('/inventoryLog', InventoryController::class);
Route::resource('/category', CategoryController::class);