<?php

use App\Http\Controllers\API\AuctionListApiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\CustomerApiController;
use App\Http\Controllers\API\EmailVerifyController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\ProductApiController;
use App\Http\Controllers\API\ResetPasswordController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    # Login & Register
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    # Verify Email
    Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'verify'])->name('verification.verify');
    Route::post('resend-verification', [EmailVerifyController::class, 'resend'])->name('verification.resend');

    # Forgot Password
    Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

     //Products
     Route::get('/products', [ProductApiController::class, 'getAllProducts']);
     Route::get('/product/{id}', [ProductApiController::class, 'productDetail']);
     //Categories
     Route::get('/categories', [CategoryApiController::class, 'getAllCategories']);

    # Authenticated
    Route::group([
        'middleware' => [
            'auth:sanctum',
            // 'verified'
        ]
    ], function () {
        # Logout
        Route::post('/logout', [AuthController::class, 'logout']);
        // //Products
        // Route::get('/products', [ProductApiController::class, 'getAllProducts']);
        // //Categories
        // Route::get('/categories', [CategoryApiController::class, 'getAllCategories']);
        //Auction List
        Route::get('get_auction_by_product_id', [AuctionListApiController::class, 'getAuctionByProductId']);
        Route::post('/auction_list_store', [AuctionListApiController::class, 'store']);
        Route::delete('/auction_list_delete/{auction_list}', [AuctionListApiController::class, 'destroy']);
        //Product
        Route::post('/products/create', [ProductApiController::class, 'store']);
        Route::get('/products/{product}', [ProductApiController::class, 'show']);
        Route::patch('/products/{product}', [ProductApiController::class, 'update']);
        Route::delete('/products/{product}', [ProductApiController::class, 'destroy']);
        //Profile
        Route::get('/profile', [CustomerApiController::class, 'getProfile']);
        Route::patch('/profile/edit', [CustomerApiController::class, 'editProfile']);
    });
});
