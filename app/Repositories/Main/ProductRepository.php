<?php

namespace App\Repositories\Main;

use App\Models\Product\Product;
use App\Models\User;

class ProductRepository implements ProductRepositoryInterface
{
    /* ***************** Create Products Function ************************ */
    public function createProduct($data)
    {
        return Product::create($data);
    }

    public function getAllProducts()
    {
        return Product::with('images')->get();
    }

    public function getProductById($id)
    {
        return Product::with('images')->find($id);
    }

    public function updateProduct($id, $data)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function deleteProduct($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }

    // Add more methods as needed...
}
