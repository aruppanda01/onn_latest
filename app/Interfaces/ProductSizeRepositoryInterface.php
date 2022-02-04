<?php

namespace App\Interfaces;

interface ProductSizeRepositoryInterface
{
    public function getAllProductSizes();
    public function findProductSizeById(int $id);
    public function createProductSize(array $productSizeDetails);
    public function updateProductSize(array $productSizeDetails);
}
