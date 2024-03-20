<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'name_on_card',
        'card_number',
        'expiry_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
