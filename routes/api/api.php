<?php

use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Traning\LearningPathController;
use Illuminate\Support\Facades\Route;

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

// Auth Routes

// Route::apiResource('/category',CategoryController::class);
// Route::apiResource('/learning-path',LearningPathController::class);

include('auth.php');