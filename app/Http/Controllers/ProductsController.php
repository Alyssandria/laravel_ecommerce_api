<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsQueryRequest;
use App\Services\ProductService;


class ProductsController extends Controller
{
    public function index(ProductsQueryRequest $request, ProductService $products) {
        return $products->getMany($request->validated());
    }

    public function indexByCategory(ProductsQueryRequest $request, string $category, ProductService $products) {
        return $products->getManyByCategory($category, $request->validated());
    }
}
