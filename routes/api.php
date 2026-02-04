<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


// register routes
Route::post('/register' , [RegisterController::class, 'store']);

// session routes
Route::post('/login' , [SessionController::class, 'store']);
Route::delete('/logout' , [SessionController::class, 'destroy']);


// items routes
Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item}', [ItemController::class, 'show']);
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
