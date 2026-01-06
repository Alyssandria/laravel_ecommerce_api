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
     * Retrieves all the cart items of this specified user
     * @return HasMany<CartItem,User>
     */
    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }
    /**
     * Retrieves all the addresses of this specified user
     * @return HasMany<Address,User>
     */
    public function addresses(): HasMany {
        return $this->hasMany(Address::class);

    }
    /**
     * Retrieves all the orders of this specified user
     * @return HasMany<Order,User>
     */
    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }
}
