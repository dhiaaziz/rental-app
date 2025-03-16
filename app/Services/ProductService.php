<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Models\Product;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepo
    ) {}

    public function getAllProducts()
    {
        return $this->productRepo->all();
    }

    public function createProduct(array $data): Product
    {
        return $this->productRepo->create($data);
    }

    public function updateProduct(Product $product, array $data): Product
    {
        return $this->productRepo->update($product, $data);
    }

    public function deleteProduct(Product $product): bool
    {
        return $this->productRepo->delete($product);
    }
}
