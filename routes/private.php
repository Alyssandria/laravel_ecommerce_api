<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// USER RELATED ROUTES
Route::get('/me', [UserController::class, 'GetUser']);
Route::post('/me', [UserController::class, 'PatchUser']);

// CART ITEM ROUTES
Route::post('/cart-items', [CartItemController::class, 'store']);
