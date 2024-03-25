<?php

namespace App\Repositories\Main\Order;

interface OrderRepositoryInterface
{
    public function placeOrder($data);
}