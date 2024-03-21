<?php

namespace App\Repositories\Main;

interface ProductRepositoryInterface
{
    public function createProduct($data);
    public function getAllProducts();
    public function getProductById($id);
    public function editProduct($id);
    public function updateProduct($id, $data);
    public function deleteProduct($id);
}