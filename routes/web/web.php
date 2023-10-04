<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Dashboard\HomeController;

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
Route::get('/home', function(){ return redirect()->route('dashboard.home'); });

// Auth
include('auth.php');

// Dashboard
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:Super Admin|Admin|Employee'])->group(function () {
    // Home
    Route::get('/', [HomeController::class,'index'])->name('home');
});