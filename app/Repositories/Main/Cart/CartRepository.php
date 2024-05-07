<?php

namespace App\Repositories\Main\Cart;

use App\Models\Cart\Cart;
use App\Models\Product\Product;
use App\Repositories\Main\Cart\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function addToCart($request)
    {
        $user = auth()->user();
        $productId = $request->product_id;
        $requestedQuantity = $request->quantity ?? 1;

        // Retrieve the product
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        if ($product->stock < $requestedQuantity) {
            return response()->json([
                'message' => 'Requested quantity exceeds available stock'
            ], 400);
        }

        // Check if the product already exists in the user's cart
        $existingCart = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingCart) {           
            return response()->json([
                'message' => 'Product already exists in cart'
            ], 200);

        } else {
            // If the product does not exist, create a new cart entry
            $cart = Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $requestedQuantity
            ]);
            return response()->json([
                'message' => 'Product added to cart successfully',
                'cart' => $cart
            ], 200);
        }
    }


    public function getAllCartItems()
    {
        $userCart = Cart::with([
            'product' => function ($query) {
                $query->select('id', 'name', 'price', 'thumbnail', 'stock');
            }
        ])->where('user_id', auth()->user()->id)
        ->orderBy('created_at', 'desc')->get();
        return $userCart;
    }

    public function updateCartItem($id, $request)
    {
        $cart = Cart::find($id);
        if ($cart) {
            // Retrieve the product associated with the cart item
            $product = $cart->product;

            // Calculate the new quantity
            $newQuantity = $request->quantity ?? $cart->quantity;

            // Check if the new quantity exceeds the available stock
            if ($product->stock >= $newQuantity) {
                $cart->update([
                    'quantity' => $newQuantity
                ]);
                return response()->json([
                    'message' => 'Cart item updated successfully',
                    'cart' => $cart
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Requested quantity exceeds available stock'
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Cart item not found'
            ], 404);
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