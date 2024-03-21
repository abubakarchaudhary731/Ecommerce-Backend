<?php

namespace App\Models\Order;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckoutItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cart_ids',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
