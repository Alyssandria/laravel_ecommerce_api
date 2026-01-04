<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemCreateRequest;
use App\Http\Requests\CartItemUpdateRequest;
use App\Models\CartItem;
use App\Services\CartItemService;


class CartItemController extends Controller
{
    public function patch(CartItemUpdateRequest $request, CartItem $cartItem, CartItemService $cart) {
        return $cart
            ->update(
                $request->user(),
                $cartItem,
                $request->validated()
            );
    }
    public function store(CartItemCreateRequest $request, CartItemService $cart) {
        return $cart
            ->create(
                $request->user(),
                collect($request->validated()
            )
        );
    }
}
