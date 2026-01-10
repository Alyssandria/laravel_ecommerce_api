<?php

use App\Enums\Enums\ProductCategories;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['hi' => 'Hello']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Product Routes
Route::controller(ProductsController::class)
    ->prefix('/products')
    ->group(function () {

        // GET ALL
        Route::get('/', 'index');

        // GET SINGLE
        Route::get('/{product}', 'show')
            ->whereNumber('product');

        // GET BY CATEGORY
        Route::get('/category/{category}', 'indexByCategory')
            ->whereIn('category', ProductCategories::cases());
    });

