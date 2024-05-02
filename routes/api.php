<?php

use App\Http\Controllers\Main\CartController;
use App\Http\Controllers\Main\CheckoutController;
use App\Http\Controllers\Main\OrderController;
use App\Http\Controllers\UserDetailController;
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

header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin,Access-Control-Allow-Headers, Content-Type, X-Auth-Token , Authorization, X-Request-With');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);
});

/* *************************** User API's *************************** */
Route::group(['prefix' => 'v1'], function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('products', 'index');
        Route::get('products/{slug}', 'show');
    });

    /* *************************** User Auth Protected API's *************************** */
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [LoginController::class, 'logout']);

        Route::controller(UserDetailController::class)->group(function () {
            Route::post('useraddress/store', 'addressStore');
            Route::post('useraddress/update/{id}', 'addressUpdate');
            Route::post('useraddress/delete/{id}', 'addressDelete');
            Route::post('paymentdetail/store', 'paymentDetailStore');
            Route::post('paymentdetail/update/{id}', 'paymentDetailUpdate');
            Route::post('paymentdetail/delete/{id}', 'paymentDetailDelete');
        });

        Route::controller(CartController::class)->group(function () {
            Route::get('cart', 'index');
            Route::post('cart/store', 'store');
            Route::post('cart/update/{id}', 'update');
            Route::post('cart/delete/{id}', 'destroy');
        });

        Route::controller(CheckoutController::class)->group(function () {
            Route::post('checkout/store', 'proceedToCheckout');
        });

        Route::controller(OrderController::class)->group(function () {
            Route::post('order/store', 'store');
            Route::post('order/cancel/{id}', 'cancel');
            Route::get('order/history', 'history');
        });
    });

    /* *************************** Admin API's *************************** */
    Route::controller(ProductController::class)->group(function () {
        Route::post('products/store', 'store');
        Route::get('products/edit/{id}', 'edit');
        Route::post('products/update/{id}', 'update');
        Route::post('products/delete/{id}', 'destroy');
    });
});
