<?php

namespace App\Interfaces;

interface SubCategoryRepositoryInterface
{
    public function getAllSubCategory();
    public function getAllCategory();
    public function findSubCategoryById(int $id);
    public function createSubCategory(array $categoryDetails);
    public function updateSubCategory(array $categoryDetails);
}
