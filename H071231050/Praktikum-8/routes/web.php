<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\aboutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [homeController::class, 'home'])->name('home');
Route::get('/about', [aboutController::class, 'about'])->name('about');
Route::get('/contact', [contactController::class, 'contact'])->name('contact');