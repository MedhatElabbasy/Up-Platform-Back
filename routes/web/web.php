<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Dashboard\HomeController;
use App\Http\Controllers\Web\Dashboard\CategoryController;
use App\Http\Controllers\Web\Dashboard\CourseController;
use App\Http\Controllers\Web\Dashboard\SectionController;
use App\Http\Controllers\Web\Dashboard\LessonController;
use App\Http\Controllers\Web\Dashboard\ProfileController;

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
Route::get('/', function(){ return redirect()->route('dashboard.home'); });
Route::get('/home', function(){ return redirect()->route('dashboard.home'); });

// Auth
include('auth.php');

// Dashboard
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:Super Admin|Admin|Employee'])->group(function () {
    // Profile
    Route::resource('/profile', ProfileController::class)->only(['index', 'store']);

    // Home
    Route::get('/', [HomeController::class,'index'])->name('home');
    
    // Categories
    Route::resource('/categories', CategoryController::class);

    // Courses
    Route::resource('/courses', CourseController::class);

    // Courses sections
    Route::resource('/courses/{course}/sections', SectionController::class);

    // Sections lessons
    Route::resource('/sections/{section}/lessons', LessonController::class);
});