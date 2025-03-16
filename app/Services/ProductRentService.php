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

    public function createProductRentForUser(array $data, $user): ProductRent
    {
        $data['user_id'] = $user->id;

        // Convert times to Carbon if not already
        $start = Carbon::parse($data['start_time']);
        $end   = Carbon::parse($data['end_time']);

        // Check availability
        $available = $this->rentRepo->isTimeSlotAvailable(
            $data['product_id'],
            $start,
            $end
        );

        if (! $available) {
            throw new \Exception('Product is already booked for that time slot.');
        }

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

    /**
     * Return an array of hour strings that are already booked
     * for the given product on a specific date. E.g. ['09:00', '10:00']
     */
    public function getBookedHoursForDate(int $productId, string $dateYmd): array
    {
        // 1. Query all rent records for that product on that date.
        //    We'll consider any record that starts or ends within that day.
        //    A simpler approach is to query "start_time" on date, but
        //    for full correctness, we might compare date ranges.
        $startOfDay = Carbon::parse($dateYmd)->startOfDay();
        $endOfDay   = Carbon::parse($dateYmd)->endOfDay();

        $rents = $this->rentRepo->getProductRentsBetween($productId, $startOfDay, $endOfDay);

        // 2. Convert each rent's start-end times to "hour blocks" it occupies.
        //    Example: if a rent is from 09:00 to 11:00, it covers 09:00 and 10:00 hours.
        $bookedHours = [];

        foreach ($rents as $rent) {
            // Convert to Carbon for iteration
            $current = Carbon::parse($rent->start_time);
            $rentEnd = Carbon::parse($rent->end_time);

            while ($current < $rentEnd) {
                // Add hour in 'HH:mm' format
                $bookedHours[] = $current->format('H:i');
                $current->addHour();
            }
        }

        // Remove duplicates
        $bookedHours = array_unique($bookedHours);

        // Sort the hours if needed
        // usort($bookedHours, function($a, $b) {
        //    return (int)str_replace(':','',$a) - (int)str_replace(':','',$b);
        // });

        return $bookedHours;
    }
}
