<?php

namespace App\Models\Product;

use App\Models\Cart\Cart;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'discount_id',
        'name',
        'slug',
        'description',
        'thumbnail',
        'brand',
        'price',
        'stock',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function discount()
    {
        return $this->belongsTo(ProductDiscount::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}

