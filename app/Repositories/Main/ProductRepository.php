<?php

namespace App\Repositories\Main;

use Illuminate\Support\Str;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;

class ProductRepository implements ProductRepositoryInterface
{
    /* ************************ Create Products Function ************************ */
    public function createProduct($data)
    {
        // Check if the category exists, or create it if it doesn't
        $category = ProductCategory::firstOrCreate(['name' => $data['category_name']]);

        $product = Product::create([
            'category_id' => $category->id,
            'discount_id' => $data['discount_id'] ?? null,
            'name' => $data['name'],
            'slug' => $this->generateUniqueSlug($data['name']),  // Use the unique slug
            'description' => $data['description'],
            'thumbnail' => $data['thumbnail'],
            'brand' => $data['brand'] ?? 'no brand',
            'price' => $data['price'],
            'stock' => $data['stock'],
        ]);

        // Create images associated with the product
        $images = [];
        if (isset ($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $imageData) {
                // Check if $imageData is an array with 'path' key
                if (is_array($imageData) && isset ($imageData['path'])) {
                    $image = $product->images()->create(['path' => $imageData['path']]);
                    $images[] = $image;
                }
            }
        }

        return [
            'product' => $product,
            'images' => $images,
        ];
    }

    /* ************************ Get All Products Function ************************ */
    public function getAllProducts()
    {
        return Product::with([
            'images' => function ($query) {
                $query->select('product_id', 'path'); // Select only the 'product_id' and 'path' columns
            }
        ])->get();
    }

    /* ************************ Get Product By ID Function ************************ */
    public function getProductById($id)
    {
        return Product::with([
            'images' => function ($query) {
                $query->select('product_id', 'path');
            }
        ])->find($id);
    }

    /* ************************ Update Product Function ************************ */
    public function editProduct($id)
    {
        return Product::with([
            'images' => function ($query) {
                $query->select('product_id', 'path');
            }
        ])->find($id);
    }

    /* ************************ Update Product Function ************************ */
    public function updateProduct($id, $data)
    {
        $product = Product::find($id);

        if ($product) {
            // Check if the category exists, or create it if it doesn't
            $category = ProductCategory::firstOrCreate(['name' => $data['category_name']]);

            // Update the product attributes
            $product->update([
                'category_id' => $category->id,
                'discount_id' => $data['discount_id'] ?? null,
                'name' => $data['name'],
                'slug' => $this->generateUniqueSlug($data['name']),  // Use the unique slug
                'description' => $data['description'],
                'thumbnail' => $data['thumbnail'],
                'brand' => $data['brand'] ?? 'no brand',
                'price' => $data['price'],
                'stock' => $data['stock'],
            ]);

            // Create images associated with the product
            if (isset ($data['images']) && is_array($data['images'])) {
                foreach ($data['images'] as $imageData) {
                    // Check if $imageData is an array with 'path' key
                    if (is_array($imageData) && isset ($imageData['path'])) {
                        $product->images()->create(['path' => $imageData['path']]);
                    }
                }
            }

            // Retrieve the updated product with images
            $updatedProduct = Product::with('images')->find($id);

            return $updatedProduct;
        }

        return response()->json([
            'message' => 'Product not Found',
        ]);
    }



    /* ************************ Delete Product Function ************************ */
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully',
            ]);
        }
        return response()->json([
            'message' => 'Product not Found',
        ]);
    }

    /* ************************ Function to generate a unique slug ************************ */
    private function generateUniqueSlug($name)
    {
        $slug = str::slug($name); // Generate initial slug from name

        // Check if the slug already exists in the products table
        $count = Product::where('slug', $slug)->count();

        // If the slug already exists, append a number to make it unique
        if ($count > 0) {
            $suffix = 2;
            while (Product::where('slug', $slug . '-' . $suffix)->count() > 0) {
                $suffix++;
            }
            $slug .= '-' . $suffix;
        }

        return $slug;
    }
}
