<?php

namespace App\Models\Order;

use App\Models\User;
use App\Models\Order\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'order_number',
      'payment_method',
      'payment_status',
      'total_price',
      'shipping_status',
      'address_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
