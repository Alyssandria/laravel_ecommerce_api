<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    /**
     * Gets all the cart items of this user
     * @return HasMany<CartItem,User>
     */
    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }
    /**
     * Gets all the addresses of this user
     * @return HasMany<Address,User>
     */
    public function addresses(): HasMany {
        return $this->hasMany(Address::class);

    }
}
