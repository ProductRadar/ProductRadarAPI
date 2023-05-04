<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
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

/* Rating & Favorite Controller */
Route::apiResource('/rating', RatingController::class)->middleware('auth:sanctum');
Route::apiResource('/favorite', FavoriteController::class)->middleware("auth:sanctum");

/* Product Controller */
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product', [ProductController::class, 'store'])->name('product.store')->middleware("auth:sanctum");
Route::put('/product/{product}', [ProductController::class, 'update'])->name('auth.update')->middleware("auth:sanctum");
Route::delete('/product', [ProductController::class, 'delete'])->name('auth.delete')->middleware("auth:sanctum");

/* Auth Controller */
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');

