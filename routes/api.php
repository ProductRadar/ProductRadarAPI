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


/* Group to hold all protected routes */
Route::group(['middleware' => ['auth:sanctum']], function () {
    /* Get current user */
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /* Rating controller */
    Route::apiResource('/rating', RatingController::class);
    /* Product controller */
    Route::apiResource('/product', ProductController::class);
    /* Favorite controller */
    Route::apiResource('/favorite', FavoriteController::class);

    /* Custom rating routes */
    Route::get('/getUserRatings', [RatingController::class, 'getUserRatings'])->name('rating.getUserRatings');
    Route::get('/getUserRating/{product_id}', [RatingController::class, 'getUserRating'])->name('rating.getUserRating');

    /* Custom favorite routes */
    Route::get('/getUserFavorites', [FavoriteController::class, 'getUserFavorites'])->name('favorite.getUserFavorites');
    Route::get('/getUserFavorite/{product_id}', [FavoriteController::class, 'getUserFavorite'])->name('favorite.getUserFavorite');

    /* Overwrites default delete route for favorite */
    Route::delete('/favorite', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
});

######################### Unprotected routes #########################

/* Product Controller */
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

/* Search product */
Route::get('/search/{search}', [SearchController::class, 'searchProduct'])->name('product.search');

/* Auth Controller */
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');

