<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    protected $fillable = [
        'recipient_name',
        'phone',
        'email',
        'city',
        'province',
        'street',
        'label',
        'user_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Gets the user that this address belongs to
     * @return HasOne<User,Address>
     */
    public function user(): HasOne {
        return $this->hasOne(User::class);
    }
}
