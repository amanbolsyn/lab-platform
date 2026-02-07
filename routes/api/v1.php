<?php

use App\Http\Controllers\Api\v1\RegisterController;
use App\Http\Controllers\Api\v1\DashboardController;
use App\Http\Controllers\Api\v1\ItemController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\V1\SessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    
    // register routes
    Route::post('/register', [RegisterController::class, 'store']);

    // session routes
    Route::post('/login', [SessionController::class, 'store']);
    Route::middleware("auth:sanctum")->post('/logout', [SessionController::class, 'destroy']);

 
    // items routes
    Route::middleware("auth:sanctum")->get('/', [ItemController::class, 'index']);
    Route::middleware("auth:sanctum")->get('/item/{item}', [ItemController::class, 'show'])
      ->name('item.show');
    Route::post('/item', [ItemController::class, 'store']);
    Route::put('/item/{item}', [ItemController::class, 'update']);
    Route::delete('/item/{item}', [ItemController::class, 'destroy']);


    // order routes
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/order/{order}', [OrderController::class, 'show']);
    Route::post('/order/create', [OrderController::class, 'store']);
    Route::put('/order/{order}', [OrderController::class, 'update']);
    Route::delete('/order/{order}', [OrderController::class, 'destroy']);


    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
