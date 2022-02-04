<?php

namespace App\Interfaces;

interface ImageRepositoryInterface
{
    public function getAllImages();
    public function findImageById(int $id);
    public function createImageDetails(array $imageDetails);
    public function updateImageDetails(array $imageDetails);
}
