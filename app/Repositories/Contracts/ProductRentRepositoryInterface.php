<?php

namespace App\Repositories\Contracts;

use App\Models\ProductRent;
use Illuminate\Database\Eloquent\Collection;

interface ProductRentRepositoryInterface
{
    /**
     * Get all product rents (likely for admin).
     */
    public function all(): Collection;

    /**
     * Find a product rent by ID or fail.
     */
    public function find(int $id): ProductRent;

    /**
     * Create a new product rent.
     */
    public function create(array $data): ProductRent;

    /**
     * Update a product rent.
     */
    public function update(ProductRent $rent, array $data): ProductRent;

    /**
     * Delete a product rent.
     */
    public function delete(ProductRent $rent): bool;
}
