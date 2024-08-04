<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BIDController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\LandingPageController;

require __DIR__.'/auth.php';

Route::get('/', LandingPageController::class)->name('frontpage');
Route::get('auctions', [ProductController::class, 'index'])->name('product.index');
Route::get('auctions/{product}', [ProductController::class, 'show'])->name('product.detail');

Route::post('make-bid', [BIDController::class, 'makeBid'])->name('make-bid');
Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
Route::get('faq', [PageController::class, 'faq'])->name('faq');
Route::get('about-us', [PageController::class, 'aboutUs'])->name('about-us');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:customer')->group(function () {
    Route::get('/profile/dashboard', [ProfileController::class, 'dashboard'])->name('profile.dashboard');

    Route::get('/profile', [ProfileController::class, 'personal'])->name('profile.personal.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
