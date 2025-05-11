<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperOrder
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    'name', 'email', 'address', 'city', 'state', 'zip', 'total',
    'status', 'payment_status', 'payment_method', 'transaction_id', 'placed_at',
    ];
    protected $casts = [
        'placed_at' => 'datetime',
    ];

    
    
    public function items()
{
    return $this->hasMany(OrderItem::class);
} 
    public function user()
{
    return $this->belongsTo(User::class);
}
}

