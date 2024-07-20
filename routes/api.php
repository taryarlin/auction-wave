<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductApiController;
use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\EmailVerifyController;
use App\Http\Controllers\API\ResetPasswordController;
use App\Http\Controllers\API\AuctionListApiController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Models\AuctionList;

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

    # Authenticated
    Route::group([
        'middleware' => ['auth:sanctum', 'verified']
    ], function () {
        # Logout
        Route::post('/logout', [AuthController::class, 'logout']);
        //Products
        Route::get('/products', [ProductApiController::class, 'getAllProducts']);
        //Categories
        Route::get('/categories', [CategoryApiController::class, 'getAllCategories']);
        //Auction List
        Route::get('get_auction_by_product_id', [AuctionListApiController::class, 'getAuctionByProductId']);
        Route::post('/auction_list_store', [AuctionListApiController::class, 'store']);
        Route::delete('/auction_list_delete/{auction_list}', [AuctionListApiController::class, 'destroy']);
    });
});
