<?php

namespace App\Repositories\Main\Order;

interface OrderRepositoryInterface
{
    public function placeOrder($data);

    public function cancelOrder($id);

    public function orderHistory();

    public function orderDetails($id);
}