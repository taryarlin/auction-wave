<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmailVerifyController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\ResetPasswordController;
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

    # Authenticated
    Route::group([
        'middleware' => ['auth:sanctum', 'verified']
    ], function () {
        //
    });
});
