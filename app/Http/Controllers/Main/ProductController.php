<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->product->createProduct($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->product->getProductById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
