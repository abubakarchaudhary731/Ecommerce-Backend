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
                    $query->select('id', 'name', 'price', 'thumbnail');
                }
            ])->where('user_id', auth()->user()->id)->find($id);
            if ($product) {
                $total += $product->quantity * $product->product->price;
                $products[] = $product;
            }
        }

        return [
            'products' => $products, 
            'total' => $total
        ];
    }

}