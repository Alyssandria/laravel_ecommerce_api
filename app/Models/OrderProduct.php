<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderProduct extends Model
{
    protected $fillable = [
        'price',
        'image',
        'quantity',
        'product_name',
        'product_link',
        'order_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Retrieves the order that the specified product belongs to
     * @return HasOne<Order,OrderProduct>
     */
    public function order(): HasOne {
        return $this->hasOne(Order::class);
    }
}
