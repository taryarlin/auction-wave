<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BIDController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ContactMessageController;
use App\Filament\Resources\ProductResource\Pages\ViewProductBidHistory;

require __DIR__.'/auth.php';

Route::get('/', LandingPageController::class)->name('frontpage');
Route::get('auctions', [ProductController::class, 'index'])->name('product.index');
Route::get('auctions/{product}', [ProductController::class, 'show'])->name('product.detail');

Route::post('make-bid', [BIDController::class, 'makeBid'])->name('make-bid');
// Route::get('contact-us', [ContactMessageController::class, 'index'])->name('contact-us');
Route::get('contact', [ContactMessageController::class, 'create'])->name('contact.create');
Route::post('contact', [ContactMessageController::class, 'store'])->name('contact.store');
Route::get('faq', [PageController::class, 'faq'])->name('faq');
Route::get('about-us', [PageController::class, 'aboutUs'])->name('about-us');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:customer')->group(function () {
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

        Route::get('/', [ProfileController::class, 'personal'])->name('personal.index');
        Route::get('/personal/edit', [ProfileController::class, 'personalEdit'])->name('personal.edit');
        Route::put('/personal/update', [ProfileController::class, 'personalUpdate'])->name('personal.update');
        Route::get('/personal/change-password', [ProfileController::class, 'personalChangePassword'])->name('personal.change-password');
        Route::patch('/personal/update-password', [ProfileController::class, 'personalUpdatePassword'])->name('personal.update-password');
        Route::get('/personal/profile-image/edit', [ProfileController::class, 'personalProfileImageEdit'])->name('personal.profile-image.edit');
        Route::patch('/personal/profile-image/update', [ProfileController::class, 'personalProfileImageUpdate'])->name('personal.profile-image.update');

        Route::get('/my-product', [ProfileController::class, 'myProduct'])->name('my-product.index');
        Route::get('/my-product/create', [ProfileController::class, 'myProductCreate'])->name('my-product.create');
        Route::post('/my-product/store', [ProfileController::class, 'myProductStore'])->name('my-product.store');
        Route::get('/my-product/{product}/edit', [ProfileController::class, 'myProductEdit'])->name('my-product.edit');
        Route::put('/my-product/{product}/update', [ProfileController::class, 'myProductUpdate'])->name('my-product.update');
        Route::delete('/my-product/{product}/delete', [ProfileController::class, 'myProductDelete'])->name('my-product.delete');

        Route::get('/my-bid', [ProfileController::class, 'myBid'])->name('my-bid.index');

        Route::get('/winning-bid', [ProfileController::class, 'winningBid'])->name('winning-bid.index');
    });
});

Route::get('/admin/products/view-product-bid-history/{record}', ViewProductBidHistory::class)->name('filament.resources.product-resource.pages.view-product-bid-history');
