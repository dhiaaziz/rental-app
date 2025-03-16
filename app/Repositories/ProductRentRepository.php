<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\ProductRent;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\ProductRentRepositoryInterface;

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


    /**
     * Check if product is free (no overlapping rent) in [startTime, endTime).
     * Return true if available, false if not.
     */
    public function isTimeSlotAvailable(int $productId, $startTime, $endTime): bool
    {
        // Ensure $startTime and $endTime are Carbon instances
        $start = $startTime instanceof Carbon ? $startTime : Carbon::parse($startTime);
        $end   = $endTime instanceof Carbon ? $endTime : Carbon::parse($endTime);

        // Query for any overlapping reservations
        $exists = ProductRent::where('product_id', $productId)
            ->where(function ($query) use ($start, $end) {
                $query->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })
            ->exists();

        // If an overlapping record exists, the slot is not available
        return ! $exists;
    }

    public function getProductRentsBetween(int $productId, Carbon $start, Carbon $end)
    {
        return ProductRent::where('product_id', $productId)
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })
            ->get();
    }
}
