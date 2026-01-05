<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// USER ROUTES
Route::get('/me', [UserController::class, 'GetUser']);
Route::post('/me', [UserController::class, 'PatchUser']);

// CART ITEM ROUTES
Route::controller(CartItemController::class)
    ->prefix('/cart-items')
    ->group(function () {
        // CREATE
        Route::post('/', 'store');

        // UPDATE
        Route::patch('/{cartItem}', 'patch')
            ->whereNumber('cartItem');

        // DELETE
        Route::delete('/', 'delete');

        // GET ALL
        Route::get('/', 'index');
    });

// Shipping Address
Route::controller(AddressController::class)
    ->prefix('/addresses')
    ->group(function () {

        // GET ALL
        Route::get('/', 'index');

        Route::get('/{address}', 'show')
            ->whereNumber('address');

        // CREATE
        Route::post('/', 'store');

        // UPDATE
        Route::patch('/{address}', 'patch')
            ->whereNumber('address');

        // DELETE
        Route::delete('/{address}', 'delete')
            ->whereNumber('address');


});
