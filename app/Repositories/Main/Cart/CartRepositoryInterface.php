<?php

namespace App\Repositories\Main\Cart;

interface CartRepositoryInterface
{
    public function addToCart($data);
    public function getAllCartItems();
    public function updateCartItem($id, $data);
    public function deleteCartItem($id);
}