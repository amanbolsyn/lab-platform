<?php

use App\Http\Controllers\Api\v1\RegisterController;
use App\Http\Controllers\Api\v1\DashboardController;
use App\Http\Controllers\Api\v1\ItemController;
use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProgramController;
use App\Http\Controllers\Api\V1\SessionController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

  // register routes
  Route::post('/register', [RegisterController::class, 'store']);

  // session routes
  Route::post('/login', [SessionController::class, 'store']);
  Route::middleware("auth:sanctum")->post('/logout', [SessionController::class, 'destroy']);


  // item routes
  Route::get('/', [ItemController::class, 'index']);
  Route::middleware("auth:sanctum")->get('/item/{item}', [ItemController::class, 'show'])
    ->name('item.show');
  Route::middleware("auth:sanctum")->post('/items', [ItemController::class, 'store']);
  Route::middleware("auth:sanctum")->put('/item/{item}', [ItemController::class, 'update']);
  Route::middleware("auth:sanctum")->delete('/item/{item}', [ItemController::class, 'destroy']);


  //user routes
  Route::middleware("auth:sanctum")->get("/users", [UserController::class, 'index']);
  Route::middleware("auth:sanctum")->get("/user/{user}", [UserController::class, 'show'])
    ->name('user.show');


  // order routes
  Route::middleware("auth:sanctum")->get('/carts', [CartController::class, 'index']);
  Route::middleware("auth:sanctum")->get('/cart/{cart}', [CartController::class, 'show'])
    ->name("cart.show");
  Route::post('/cart', [CartController::class, 'store']);
  Route::put('/cart/{cart}', [CartController::class, 'update']);
  Route::delete('/cart/{cart}', [CartController::class, 'destroy']);


  // dashboard
  Route::get('/dashboard', [DashboardController::class, 'index']);


  //program routes
  Route::middleware("auth:sanctum")->get('/programs', [ProgramController::class, 'index']);
  Route::middleware("auth:sanctum")->post('/programs', [ProgramController::class, 'store']);
  Route::middleware("auth:sanctum")->put('/programs/{program}', [ProgramController::class, 'update']);
  Route::middleware("auth:sanctum")->delete('/programs/{program}', [ProgramController::class, 'destroy']);

  //category routes
  Route::middleware("auth:sanctum")->get('/categories', [CategoryController::class, 'index']);
  Route::middleware("auth:sanctum")->post('/categories', [CategoryController::class, 'store']);
  Route::middleware("auth:sanctum")->put('/categories/{category}', [CategoryController::class, 'update']);
  Route::middleware("auth:sanctum")->delete('/categories/{category}', [CategoryController::class, 'destroy']);
});
