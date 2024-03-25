<?php

namespace App\Repositories\Main\Order;

use App\Models\Cart\Cart;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Repositories\Main\Order\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function placeOrder($request)
    {
        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD_' . uniqid(),
            'payment_method' => $request->payment_method,
            'total_price' => $request->total_price,
            'address_id' => $request->address_id,
            'shipping_status' => 'processing',
            'payment_status' => 'pending'
        ]);

        if ($order) {
            // Get cart items
            $cartItems = Cart::where('user_id', auth()->id())
                                ->whereIn('id', $request->cartIds)
                                ->with('product:id,price,stock')
                                ->get();

            // Process each cart item
            foreach ($cartItems as $cartItem) {
                // Create order item
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product->id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);

                // Deduct quantity from product stock
                $cartItem->product->stock -= $cartItem->quantity;
                $cartItem->product->save();
            }
        }

        return $order;
    }

}