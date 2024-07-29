<?php

use App\Http\Controllers\BIDController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', LandingPageController::class)->name('frontpage');
Route::get('auctions', [ProductController::class, 'index'])->name('product.index');
Route::get('auctions/{product}', [ProductController::class, 'show'])->name('product.detail');

Route::post('make-bid', [BIDController::class, 'makeBid'])->name('make-bid');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
