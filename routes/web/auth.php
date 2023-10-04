<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Dashboard\Auth\LoginController;
use App\Http\Controllers\Web\Dashboard\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Redirect
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Dashboard
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::middleware('guest')->group(function () { // Guest
        // Login
        Route::resource('/login', LoginController::class)->only(['index', 'store']);

        // Forgot password
        Route::resource('/forgot-password', ForgotPasswordController::class)->only(['index', 'store', 'update']);
    });
    
    Route::middleware('auth')->group(function () { // Auth
        Route::get('/logout', [LoginController::class, 'logout']);
    });
});