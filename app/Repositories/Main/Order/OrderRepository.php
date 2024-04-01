<?php

namespace App\Repositories\Main\Order;

use App\Jobs\OrderConfirmationJob;
use App\Mail\User\OrderConfirmationMessage;
use App\Models\Cart\Cart;
use App\Models\Order\Order;
use App\Mail\Admin\PlaceOrder;
use App\Models\Order\OrderItem;
use Illuminate\Support\Facades\Mail;
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
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);

        if ($order) {
            // Get cart items
            $cartItems = Cart::where('user_id', auth()->id())
                ->whereIn('id', $request->cartIds)
                ->with('product:id,name,price,stock')
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

                // Remove cart item
                $cartItem->delete();
            }
            // Sent Place Order Message to Admin
            $detail = [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'order_number' => $order->order_number,
                'total_price' => $order->total_price,
            ];
            if (dispatch(new OrderConfirmationJob($detail))) {
                return response()->json([
                    'message' => 'Your Order Email has been placed successfully',
                    'order' => $order
                ]);                 
            }
        }
    }

    public function cancelOrder($id)
    {
        $cancelOrder = Order::find($id);
        if ($cancelOrder) {
            $cancelOrder->order_status = 'cancelled';
            $cancelOrder->save();

            return response()->json([
                'message' => 'Your Order has been cancelled successfully',
            ]);
        }

        return response()->json([
            'message' => 'Order not found',
        ], 404);
    }


    public function orderHistory()
    {
        $orderHistory = Order::with(['orderItems', 'address', 'orderItems.product' => function ($query) {
            $query->select('id', 'name', 'thumbnail');
        }])
        ->where('user_id', auth()->id())
        ->get();
    
        return $orderHistory;
    }
    

}