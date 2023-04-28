<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SettingsController;
use App\Models\Bookmark;
use Illuminate\Http\Request;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/change-password', [ProfileController::class, 'changePassword']);
Route::post('/ranking', [RatingController::class, 'updateRanking']);

Route::controller(ContentController::class)->group(function () {
    Route::get('/getPopularContent/{userId}', 'getPopularContent');
    Route::get('/getContentByCategory/{categoryName}/{userId}', 'getContentByCategory');
    Route::get('/getNewContent/{userId}', 'getNewContent');
    Route::post('/content', 'createContent');
    Route::post('deleteContent', 'deleteContent');
});

Route::controller(SettingsController::class)->group(function () {
    Route::post('changeProfile', 'changeProfile');
    Route::post('changeProfileImg', 'changeProfileImg');
    Route::get('getProfileImg/{userId}', 'getProfileImg');
});

Route::apiResource('bookmarks', BookmarkController::class);
Route::post('updateBookmark', [BookmarkController::class, 'updateBookmark']);