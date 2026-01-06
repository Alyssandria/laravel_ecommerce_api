<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_no',
        'total',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    /**
     * Retrieves all products associated with specific order
     * @return HasMany<OrderProduct,Order>
     */
    public function orderProducts(): HasMany {
        return $this->hasMany(OrderProduct::class);
    }
}
