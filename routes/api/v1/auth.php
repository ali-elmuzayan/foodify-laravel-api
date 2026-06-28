<?php

use App\Http\Controllers\Api\V1\Auth\AuthenticatedUserController;
use App\Http\Controllers\Api\V1\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\V1\Auth\RegisteredUserController;
use App\Http\Controllers\Api\V1\Auth\ResendOTPController;
use App\Http\Controllers\Api\V1\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\Auth\RefreshTokenController;
use App\Http\Controllers\Api\V1\Auth\VerifyOTPController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Authenticatation:
/**
 * POST => /api/auth/login
 * POST => /api/auth/register
 * POST => /api/auth/logout
 * POST => /api/auth/me
 * POST => /api/auth/forgot-password
 * POST => /api/auth/reset-password
 */
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthenticatedUserController::class, 'store'])->name('login');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/forgot-password', [ForgetPasswordController::class, 'store']);
    Route::post('/reset-password', [ResetPasswordController::class, 'store']);
    Route::post('/verify-otp', [VerifyOTPController::class, '__invoke']);
    Route::post('/resend-otp', ResendOTPController::class);

});


// authenticated routes
Route::prefix('auth')->middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthenticatedUserController::class, 'destroy']);
    Route::get('/me', [AuthenticatedUserController::class, 'show']);
    Route::post('/refresh-token', [RefreshTokenController::class, '__invoke']);
});
