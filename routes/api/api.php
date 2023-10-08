<?php


use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Route;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Traning\LearningPathController;

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

Route::get('test', function(){

    FFMpeg::fromDisk('videos')
        ->open('SAMSUNG.mp4')
        ->exportForHLS()
        ->setSegmentLength(10)
        ->setKeyFrameInterval(48)
        ->addFormat(new X264)
        ->save('adaptive_steve/video.m3u8');

});