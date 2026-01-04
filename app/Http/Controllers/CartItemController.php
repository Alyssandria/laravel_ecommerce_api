<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemCreateRequest;
use App\Http\Requests\CartItemUpdateRequest;
use App\Models\CartItem;
use App\Services\CartItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


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

    public function delete(CartItem $cartItem, CartItemService $cart) {
        Gate::authorize('delete', $cartItem);
        return $cart->delete($cartItem);
    }

    public function store(CartItemCreateRequest $request, CartItemService $cart) {
        return $cart
            ->create(
                $request->user(),
                collect($request->validated()
            )
        );
    }

    public function index(Request $request, CartItemService $cart) {
        return $cart->all($request->user());
    }
}
