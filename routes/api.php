<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SearchController;
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

/* Rating Controller */
Route::apiResource('/rating', RatingController::class)->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/getUserRatings', [RatingController::class, 'getUserRatings'])->name('rating.getUserRatings');
Route::middleware('auth:sanctum')->get('/getUserRating/{product_id}', [RatingController::class, 'getUserRating'])->name('rating.getUserRating');
Route::get('rating/getProductRating/{product_id}', [RatingController::class, 'getProductRating'])->name('rating.getProductRating');

/* Favorite Controller */
Route::apiResource('/favorite', FavoriteController::class)->middleware("auth:sanctum");
Route::middleware('auth:sanctum')->get('/getUserFavorites', [FavoriteController::class, 'getUserFavorites'])->name('favorite.getUserFavorites');
Route::middleware('auth:sanctum')->get('/getUserFavorite/{product_id}', [FavoriteController::class, 'getUserFavorite'])->name('favorite.getUserFavorite');

/* Product Controller */
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product', [ProductController::class, 'store'])->name('product.store')->middleware("auth:sanctum");
Route::put('/product/{product}', [ProductController::class, 'update'])->name('auth.update')->middleware("auth:sanctum");
Route::delete('/product', [ProductController::class, 'delete'])->name('auth.delete')->middleware("auth:sanctum");

/*  Search product  */
Route::get('/search/{search}', [SearchController::class, 'searchProduct'])->name('product.search');

/* Auth Controller */
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');

