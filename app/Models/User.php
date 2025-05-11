<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Cart;
use App\Models\Order;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cart[] $carts
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $carts_count
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

   /**
 * Get the orders for the user.
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
 * Get the cart items for the user.
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
