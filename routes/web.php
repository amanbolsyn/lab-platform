<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


// register routes
Route::get('/register', [RegisterController::class, 'create']); 
Route::post('/register' , [RegisterController::class, 'store']);

// session routes
Route::get('/login', [SessionController::class, 'create']); 
Route::post('/login' , [SessionController::class, 'store']);
Route::delete('/logout' , [SessionController::class, 'destroy']);


// inventory routes
Route::get('/', [InventoryController::class, 'index']);
Route::get('/item/{item}', [InventoryController::class, 'show']);
Route::get('/item/create', [InventoryController::class, 'create']);
Route::post('/item', [InventoryController::class, 'store']);
Route::get('/item/{item}/edit', [InventoryController::class, 'edit']);
Route::put('/item/{item}', [InventoryController::class, 'update']);
Route::delete('/item/{item}', [InventoryController::class, 'destroy']);


// order routes
Route::get('/orders', [OrderController::class, 'index']); 
Route::get('/order/{order}', [OrderController::class, 'show']); 
Route::get('/order/create', [OrderController::class, 'create']);
Route::post('/order/create', [OrderController::class, 'store']); 
Route::get('/order/{order}/edit', [OrderController::class, 'edit']); 
Route::put('/order/{order}', [OrderController::class, 'update']); 
Route::delete('/order/{order}', [OrderController::class, 'destroy']);


// dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);
