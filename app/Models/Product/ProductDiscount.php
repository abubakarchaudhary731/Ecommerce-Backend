<?php

namespace App\Models\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductDiscount extends Model
{
    protected $table = 'discounts';
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'percentage',
        'is_active',
        'created_at',
        'updated_at',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
