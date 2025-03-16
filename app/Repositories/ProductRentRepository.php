<?php

namespace App\Repositories;

use App\Models\ProductRent;
use App\Repositories\Contracts\ProductRentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRentRepository implements ProductRentRepositoryInterface
{
    public function all(): Collection
    {
        return ProductRent::all();
    }

    public function find(int $id): ProductRent
    {
        return ProductRent::findOrFail($id);
    }

    public function create(array $data): ProductRent
    {
        return ProductRent::create($data);
    }

    public function update(ProductRent $rent, array $data): ProductRent
    {
        $rent->update($data);
        return $rent;
    }

    public function delete(ProductRent $rent): bool
    {
        return $rent->delete();
    }
}
