<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/rating', \App\Http\Controllers\RatingController::class)->middleware('auth:sanctum');
Route::apiResource('/favorite', \App\Http\Controllers\FavoriteController::class)->middleware("auth:sanctum");
Route::apiResource('/product', \App\Http\Controllers\ProductController::class)->middleware("auth:sanctum");
Route::group(array('namespace' => 'Front', 'prefix'=>''),function() {
    Route::post('auth/login', '\App\Http\Controllers\AuthController@login')->name('auth.login');
    Route::post('auth/register', '\App\Http\Controllers\AuthController@register')->name('auth.register');
});
