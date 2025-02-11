<?php

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

// Routes untuk Merchant
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/merchants', [MerchantsController::class, 'index']);
    Route::post('/merchants', [MerchantsController::class, 'store']);
    Route::get('/merchants/{id}', [MerchantsController::class, 'show']);
    Route::put('/merchants/{id}', [MerchantsController::class, 'update']);
    Route::delete('/merchants/{id}', [MerchantsController::class, 'destroy']);

    // Routes untuk Menu
    Route::get('/menus', [MenusController::class, 'index']);
    Route::post('/menus', [MenusController::class, 'store']);
    Route::get('/menus/{id}', [MenusController::class, 'show']);
    Route::put('/menus/{id}', [MenusController::class, 'update']);
    Route::delete('/menus/{id}', [MenusController::class, 'destroy']);

    // Routes untuk Order
    Route::get('/orders', [OrdersController::class, 'index']);
    Route::post('/orders', [OrdersController::class, 'store']);
    Route::get('/orders/{id}', [OrdersController::class, 'show']);
    // Tambahkan route untuk update order jika diperlukan
});

