<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemCreateRequest;
use App\Services\CartItemService;


class CartItemController extends Controller
{
    public function store(CartItemCreateRequest $request, CartItemService $cart) {
        return $cart
            ->create(
                $request->user(),
                collect($request->validated()
            )
        );
    }
}
