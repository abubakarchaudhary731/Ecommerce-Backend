<?php

namespace App\Repositories\Main\Checkout;

use App\Models\Order\CheckoutItem;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    public function checkoutItems($request)
    {
        $cartIds = json_encode($request->cart_ids);

        $checkoutItem = CheckoutItem::create([
            'user_id' => auth()->user()->id,
            'cart_ids' => $cartIds
        ]);

        return response()->json($checkoutItem);
    }
}