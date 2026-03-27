<?php

use App\Http\Controllers\Api\v1\RegisterController;
use App\Http\Controllers\Api\v1\DashboardController;
use App\Http\Controllers\Api\v1\ItemController;
use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProgramController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\V1\SessionController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Item;
use App\Models\Program;
use App\Models\Role;
use App\Models\User;

Route::prefix('v1')->group(function () {

  // register routes
  Route::post('/register', [RegisterController::class, 'store']);
  Route::get('/auth/verify-email/{id}/{hash}', [RegisterController::class, 'verifyEmail'])->name('verification.verify');
  Route::post('/auth/resend-verification', [RegisterController::class, 'sendVerificaton']); 
  
  // session routes
  Route::post('/login', [SessionController::class, 'store']);
  Route::middleware("auth:sanctum")->post('/logout', [SessionController::class, 'destroy']);


  // item routes
  Route::get('/items', [ItemController::class, 'index'])
    ->name('item.index');
  Route::get('/items/{item}', [ItemController::class, 'show'])
    ->name('item.show');
  Route::middleware("auth:sanctum", "verified")->post('/items', [ItemController::class, 'store'])
    ->name('item.store')
    ->can('create', Item::class);
  Route::middleware("auth:sanctum")->put('/items/{item}', [ItemController::class, 'update'])
    ->name('item.update')
    ->can('update', Item::class);
  Route::middleware("auth:sanctum")->delete('/items/{item}', [ItemController::class, 'destroy'])
    ->can('delete', Item::class);

  //user routes
  Route::middleware("auth:sanctum")->get("/users", [UserController::class, 'index'])
    ->can('viewAny', User::class)
    ->name('user.index');
  Route::middleware("auth:sanctum")->get("/users/{user}", [UserController::class, 'show'])
    ->can('view', 'user')
    ->name('user.show');
  Route::middleware("auth:sanctum")->put("/users/{user}", [UserController::class, 'update'])
    ->can('update', 'user')
    ->name('update.user');


  // carts routes
  Route::middleware("auth:sanctum")->get('/carts', [CartController::class, 'index'])
    ->can('viewAny', Cart::class)
    ->name('cart.index');
  Route::middleware("auth:sanctum")->get('/carts/{cart}', [CartController::class, 'show'])
    ->can('view', 'cart')
    ->name("cart.show");
  Route::middleware("auth:sanctum")->post('/carts', [CartController::class, 'store'])
    ->name('cart.store');
  Route::middleware("auth:sanctum")->put('/carts/{cart}', [CartController::class, 'update'])
    ->can('update', 'cart')
    ->name('cart.update');

  // dashboard
  Route::middleware("auth:sanctum")->get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('can:view-stats');

  //role routes 
  Route::middleware("auth:sanctum")->get('/roles', [RoleController::class, 'index'])
    ->can('viewAny', Role::class)
    ->name('role.index');


  //program routes
  Route::get('/programs', [ProgramController::class, 'index']);
  Route::middleware("auth:sanctum")->post('/programs', [ProgramController::class, 'store'])
    ->can('create', Program::class);
  Route::middleware("auth:sanctum")->put('/programs/{program}', [ProgramController::class, 'update'])
    ->can('update', Program::class);
  Route::middleware("auth:sanctum")->delete('/programs/{program}', [ProgramController::class, 'destroy'])
    ->can('delete', Program::class);

  //category routes
  Route::get('/categories', [CategoryController::class, 'index']);
  Route::middleware("auth:sanctum")->post('/categories', [CategoryController::class, 'store'])
    ->can('create', Category::class);
  Route::middleware("auth:sanctum")->put('/categories/{category}', [CategoryController::class, 'update'])
    ->can('update', Category::class);
  Route::middleware("auth:sanctum")->delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->can('delete', Category::class);
});
