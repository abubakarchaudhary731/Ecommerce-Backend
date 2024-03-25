<?php

namespace App\Repositories\Main\Checkout;

use App\Models\Cart\Cart;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    public function checkoutItems($request)
    {
        $cartIds = $request->cart_ids;
        $products = [];
        $total = 0;
        // Fetch product data from cart through selected idz
        foreach ($cartIds as $id) {
            $product = Cart::with([
                'product' => function ($query) {
                    $query->select('id', 'name', 'price', 'thumbnail', 'stock');
                }
            ])->where('user_id', auth()->user()->id)->find($id);
            if ($product) {
                $total += $product->quantity * $product->product->price;
                $products[] = $product;
            }
        }
        // Fetch User Address
        $userAddress = auth()->user()->userAddresses()->get();

        // Fetch User Card Details
        $userCardDetails = auth()->user()->userPaymentDetails()->get();

        return [
            'products' => $products, 
            'userAddress' => $userAddress,
            'userCardDetails' => $userCardDetails,
            'total' => $total
        ];
    }

}