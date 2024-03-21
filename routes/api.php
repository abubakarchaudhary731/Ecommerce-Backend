<?php

use App\Http\Controllers\Main\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Main\ProductController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);
});

/* *************************** User API's *************************** */
Route::group(['prefix' => 'v1'], function() {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);

/* *************************** User Protected Routes *************************** */
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [LoginController::class, 'logout']);
        Route::get('cart', [CartController::class, 'index']);
        Route::post('cart/store', [CartController::class, 'store']);
        Route::post('cart/update/{id}', [CartController::class, 'update']);
        Route::post('cart/delete/{id}', [CartController::class, 'destroy']);
        Route::post('checkout', [CartController::class, 'checkout']);
    });

/* *************************** Admin API's *************************** */
    Route::post('products/store', [ProductController::class, 'store']);
    Route::get('products/edit/{id}', [ProductController::class, 'edit']);
    Route::post('products/update/{id}', [ProductController::class, 'update']);
    Route::post('products/delete/{id}', [ProductController::class, 'destroy']);
});
