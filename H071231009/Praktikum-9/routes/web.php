<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CategoryController::class, 'index']);


Route::resource('category', CategoryController::class);

Route::resource('product', ProductController::class);

Route::resource('inventory-log', InventoryLogController::class)->except('edit', 'update');