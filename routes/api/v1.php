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
use App\Http\Controllers\Api\v1\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Document;
use App\Models\Item;
use App\Models\Program;
use App\Models\Role;
use App\Models\User;

Route::prefix('v1')->middleware(['throttle:api'])->group(function () {

  Route::controller(RegisterController::class)
    ->prefix('auth')
    ->group(function () {
      Route::post('/register',  'store');

      Route::get('/verify-email/{id}/{hash}', 'verifyEmail')
        ->name('verification.verify');
      Route::post('/resend-verification', 'sendVerification');

      Route::post('/forgot-password',  'sendResetLink');
      Route::post('/reset-password',  'resetPassword');
    });


  Route::controller(SessionController::class)
    ->prefix('session')
    ->group(function () {
      Route::post('/login',  'store');
      Route::middleware("auth:sanctum")->post('/logout',  'destroy');
    });


  Route::controller(ItemController::class)
    ->prefix('items')
    ->group(function () {
      Route::get('/',  'index')->name('item.index');
      Route::get('/{item}',  'show')->name('item.show');

      Route::middleware("auth:sanctum")->group(function () {
        Route::post('/',  'store')->can('create', Item::class)
          ->name('item.store');
        Route::put('/{item}', 'update')->can('update', Item::class)
          ->name('item.update');
        Route::delete('/{item}', 'destroy')->can('delete', Item::class);
      });
    });


  Route::controller(UserController::class)
    ->prefix('users')
    ->middleware('auth:sanctum')
    ->group(function () {
      Route::get("/", 'index')->can('viewAny', User::class)
        ->name('user.index');
      Route::get("/{user}",  'show')->can('view', 'user')
        ->name('user.show');
      Route::put("/{user}", 'update')->can('update', 'user')
        ->name('update.user');
      Route::get('/{user}/carts', 'getUserCarts')
        ->can('view', 'user')
        ->name('user.carts');
    });



  Route::controller(CartController::class)
    ->prefix('carts')
    ->middleware('auth:sanctum')
    ->group(function () {
      Route::get('/', 'index')->can('viewAny', Cart::class)
        ->name('cart.index');
      Route::get('/{cart}', 'show')->can('view', 'cart')
        ->name("cart.show");
      Route::post('/',  'store')
        ->name('cart.store');
      Route::put('/{cart}', 'update')->can('update', 'cart')
        ->name('cart.update');
    });


  Route::controller(ProgramController::class)
    ->prefix('programs')
    ->group(function () {
      Route::get('/',  'index');

      Route::middleware('auth:sanctum')->group(function () {
        Route::post('/',  'store')
          ->can('create', Program::class);
        Route::put('/{program}',  'update')
          ->can('update', Program::class);
        Route::delete('/{program}',  'destroy')
          ->can('delete', Program::class);
      });
    });


  Route::controller(CategoryController::class)
    ->prefix('categories')
    ->group(function () {
      Route::get('/', [CategoryController::class, 'index']);

      Route::middleware("auth:sanctum")->group(function () {
        Route::post('/categories', 'store')
          ->can('create', Category::class);
        Route::put('/{category}', 'update')
          ->can('update', Category::class);
        Route::delete('/{category}',  'destroy')
          ->can('delete', Category::class);
      });
    });

  Route::controller(DocumentController::class)
    ->prefix('documents')
    ->group(function () {
      Route::get('/get-safety-rules', 'getSafetyRules');

      Route::middleware(['auth:sanctum'])
        ->group(function () {
          Route::post('/store-safety-rules', 'storeSafetyRules')
            ->can('storeSafetyRules', Document::class);
          Route::delete('/delete-safety-rules', 'deleteSafetyRules')
            ->can('deleteSafetyRules', Document::class);
        });
    });


  Route::controller(DashboardController::class)
    ->prefix('dashboard')
    ->middleware(['auth:sanctum', 'can:view-stats'])
    ->group(function () {
      Route::get('/', 'index');
    });


  Route::controller(RoleController::class)
    ->prefix('roles')
    ->middleware('auth:sanctum')
    ->group(function () {
      Route::get('/', 'index')->can('viewAny', Role::class)->name('role.index');
    });
});
