<?php

namespace App\Http\Controllers\Main;

use App\Repositories\Main\Checkout\CheckoutRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    protected $checkout;
    public function __construct(CheckoutRepositoryInterface $interface)
    {
        $this->checkout = $interface;
    }

    public function proceedToCheckout(Request $request)
    {
        return $this->checkout->checkoutItems($request);
    }

}
