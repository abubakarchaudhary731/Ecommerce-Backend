<?php

namespace App\Repositories\Main\Cart;

use App\Models\Cart\Cart;
use App\Repositories\Main\Cart\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function addToCart($request)
    {
        $user = auth()->user();
        $productId = $request->product_id;

        // Check if the product already exists in the user's cart
        $existingCart = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingCart) {
            // If the product exists, update its quantity
            $existingCart->update([
                'quantity' => $existingCart->quantity + ($request->quantity ?? 1)
            ]);
            return $existingCart;
        } else {
            // If the product does not exist, create a new cart entry
            $cart = Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $request->quantity ?? 1
            ]);
            return $cart;
        }
    }

    public function getAllCartItems()
    {
        $userCart = Cart::with([
            'product' => function ($query) {
                $query->select('id', 'name', 'price', 'thumbnail', 'stock');
            }
        ])->where('user_id', auth()->user()->id)->get();
        return $userCart;
    }

    public function updateCartItem($id, $request)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->update([
                // Update the quantity if provided, otherwise keep the existing quantity
                'quantity' => $request->quantity ?? $cart->quantity
            ]);
            $cart->save();

            return $cart;
        } else {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
    }

    public function deleteCartItem($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            return response()->json([
                'message' => 'Cart item deleted successfully'
            ]);
        }

        return response()->json([
            'message' => 'Cart item not found'
        ], 404);

    }

}