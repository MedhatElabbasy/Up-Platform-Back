<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth Prefix Group
Route::prefix('auth')->controller(AuthController::class)->group(function () {
    // Register
    Route::post('/register', 'register');

    // Login
    Route::post('/login', 'login');
    Route::post('/login/provider', 'loginWithProvider');

    // Forgot Password
    Route::post('/password/forgot', 'forgotPassword');
    Route::post('/password/forgot/verify', 'forgotPasswordVerify');
    Route::post('/password/reset', 'resetPassword');

    // Login Required Group
    Route::middleware('auth:sanctum')->group(function () {
        // Verify Email
        Route::post('/email/verify/resend', 'verifyEmailResend');
        Route::post('/email/verify', 'verifyEmail');

        // Logout
        Route::post('/logout', 'logout');
    });
});