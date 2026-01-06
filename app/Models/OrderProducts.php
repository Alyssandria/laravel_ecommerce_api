<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }
}
