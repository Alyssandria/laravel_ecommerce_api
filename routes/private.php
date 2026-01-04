<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// USER RELATED ROUTES
Route::get('/me', [UserController::class, 'GetUser']);
Route::post('/me', [UserController::class, 'PatchUser']);

// CART ITEM ROUTES
Route::controller(CartItemController::class)
    ->prefix('/cart-items')
    ->group(function () {

        // CREATE
        Route::post('/', [CartItemController::class, 'store']);

        // UPDATE
        Route::patch('/{cartItem}', [CartItemController::class, 'patch'])
            ->whereNumber('cartItem');
    });
