<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\ProductRequest;
use App\Repositories\Main\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    public function __construct(ProductRepositoryInterface $interface)
    {
        $this->product = $interface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->product->getAllProducts();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $products = $this->product->createProduct($request->all());
        return $products;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->product->getProductById($id);
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->product->editProduct($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $updatedProduct = $this->product->updateProduct($id, $request->all());
        return $updatedProduct;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->product->deleteProduct($id);
    }
}
