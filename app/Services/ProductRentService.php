<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRentRepositoryInterface;
use App\Models\ProductRent;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event; // if relevant

class ProductRentService
{
    public function __construct(
        protected ProductRentRepositoryInterface $rentRepo
    ) {}

    public function createRentForUser(array $data, $user): ProductRent
    {
        $data['user_id'] = $user->id;
        $rent = $this->rentRepo->create($data);

        // Maybe integrate with Google Calendar:
        // $this->createCalendarEvent($rent);

        return $rent;
    }

    public function updateRent(ProductRent $rent, array $data): ProductRent
    {
        $updatedRent = $this->rentRepo->update($rent, $data);
        // Update calendar event if needed...
        return $updatedRent;
    }

    public function deleteRent(ProductRent $rent): bool
    {
        // Delete calendar event if needed...
        return $this->rentRepo->delete($rent);
    }
}
