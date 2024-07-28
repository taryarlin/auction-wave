<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class);
Route::get('{product}', [ProductController::class, 'show'])->name('product.detail');
