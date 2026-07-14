<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\FavoriteController;

/*
|--------------------------------------------------------------------------
| TEST API
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'API CONNECTED'
    ]);
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| FAVORITE
|--------------------------------------------------------------------------
*/

Route::post('/favorite', [FavoriteController::class, 'store']);
Route::get('/favorite/{user_id}', [FavoriteController::class, 'getFavorites']);
Route::delete('/favorite', [FavoriteController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| RATING
|--------------------------------------------------------------------------
*/

Route::get('/rating/{wisata_id}', [RatingController::class, 'getRating']);
Route::post('/rating', [RatingController::class, 'store']);

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// test