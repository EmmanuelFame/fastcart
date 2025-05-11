<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperOrderItem
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'product_id', 'name', 'quantity', 'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
{
    return $this->belongsTo(Product::class);
}

   
    
}
