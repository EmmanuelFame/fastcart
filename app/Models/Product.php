<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image', 'category_id'];
    public function getImageUrlAttribute()
{
    return asset('storage/' . $this->image);
}

public function category()
{
    return $this->belongsTo(Category::class);
}
public function reviews()
{
    return $this->hasMany(Review::class);
}

public function getAverageRatingAttribute()
{
    return $this->reviews()->avg('rating');
}

}
