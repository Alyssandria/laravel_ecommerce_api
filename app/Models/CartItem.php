<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartItem extends Model
{

    protected $fillable = [
        'quantity',
        'user_id',
        'product_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    /**
     * Gets the user of the selected cart item
     * @return HasOne<User,CartItem>
     */
    public function user(): HasOne {
        return $this->hasOne(User::class);
    }
}
