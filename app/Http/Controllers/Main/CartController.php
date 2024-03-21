<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Main\Cart\CartRepositoryInterface;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartRepositoryInterface $interface)
    {
        $this->cart = $interface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->cart->getAllCartItems();
    }

    public function store(Request $request)
    {
        return $this->cart->addToCart($request);
    }

    public function update($id, Request $request)
    {
        return $this->cart->updateCartItem($id, $request);
    }

    public function destroy($id)
    {
        return $this->cart->deleteCartItem($id);
    }
}
