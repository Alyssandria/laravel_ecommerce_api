<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_no',
        'address_id',
        'user_id',
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
    public function products(): HasMany {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * Retrieves the address associated with specific order
     */
    public function address(): BelongsTo {
        return $this->belongsTo(Address::class);
    }
}
