<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderProducts extends Model
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
     * @return HasOne<Order,OrderProduct>
     */
    public function order(): HasOne {
        return $this->hasOne(Order::class);
    }
}
