<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllSubCategory();
    public function getAllCategory();
    public function getAllProductSizes();
    public function getAllProduct();
    public function findProductById(int $id);
    public function createProduct(array $productDetails);
    public function updateProduct(array $productDetails);
}
