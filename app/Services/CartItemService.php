<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Support\Collection;

class CartItemService {
    public function create(User $user, Collection $data) {
        $cartItem = CartItem::where([
            'user_id' => $user->id,
            'product_id' => $data->get('product_id')
        ])->first();

        if($cartItem){
            $cartItem->increment('quantity');
        } else {
            $cartItem = CartItem::create([
                'product_id' => $data->get('product_id'),
                'user_id' => $user->id,
                'quantity' => $data->get('quantity')
            ]);
        }


        return response()->json(
            [
                'success' => true,
                'message' => "Cart item succesfully added",
                'data' => $cartItem->toResource()
            ]
        );
    }

}
