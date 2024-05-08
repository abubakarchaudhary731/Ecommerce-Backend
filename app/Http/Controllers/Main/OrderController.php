<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Main\Order\OrderRepositoryInterface;

class OrderController extends Controller
{

    protected $order;
    public function __construct(OrderRepositoryInterface $interface)
    {
        $this->order = $interface;
    }

    public function store(Request $request)
    {
        $placeOrder =  $this->order->placeOrder($request);
        return response()->json([
            'message' => 'Your Order has been placed successfully',
            'order' => $placeOrder
        ]);
    }

    public function cancel($id)
    {
        return $this->order->cancelOrder($id);
    }

    public function history()
    {
        $orderHistory = $this->order->orderHistory();
        return response()->json([
            'message' => 'Order History related to your account',
            'orderHistory' => $orderHistory
        ]);
    }

    public function orderDetails($id)
    {
        $orderDetails = $this->order->orderDetails($id);
        return response()->json([
            'message' => 'Order Details',
            'orderDetails' => $orderDetails
        ]);
    }
}
