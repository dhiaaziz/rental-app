<?php

namespace App\Livewire\Rent;

use Livewire\Component;
use App\Models\Product;
use App\Services\ProductRentService; // or RentService, if you have it
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateRent extends Component
{
    use AuthorizesRequests;

    public $selectedProduct;
    public $selectedDate;     // e.g., '2025-04-01'
    public $selectedHours = []; // multiple hours, e.g. ['08:00', '09:00']

    // Data for the dropdowns
    public $products = [];
    public $availableHours = [
        '08:00',
        '09:00',
        '10:00',
        '11:00',
        '12:00',
        '13:00',
        '14:00',
        '15:00',
        '16:00',
        '17:00',
        '18:00',
        '19:00',
        // Add or remove as needed
    ];

    public $unavailableHours = [];

    protected function rules()
    {
        return [
            'selectedProduct' => 'required|exists:products,id',
            'selectedDate'    => 'required|date',
            'selectedHours'   => 'required|array|min:1',
        ];
    }

    public function mount()
    {
        // If you have a policy (e.g. ProductRentPolicy), you can do:
        $this->authorize('create', ProductRent::class);

        // Load available products (adjust logic as needed)
        $this->products = Product::all();
    }
    /**
     * This is called by Alpine whenever product OR date changes in the frontend.
     */
    public function checkAvailability($productId, $dateYmd)
    {
        // Update local Livewire props
        $this->selectedProduct = $productId;
        $this->selectedDate    = $dateYmd;

        // If both are set, fetch booked hours
        if ($this->selectedProduct && $this->selectedDate) {
            $this->unavailableHours = app(ProductRentService::class)
                ->getBookedHoursForDate($this->selectedProduct, $this->selectedDate);
        } else {
            // If either is missing, reset
            $this->unavailableHours = [];
        }
    }

    public function createRents(ProductRentService $rentService)
    {
        $this->validate();

        try {
            foreach ($this->selectedHours as $hour) {
                if (in_array($hour, $this->unavailableHours)) {
                    throw new \Exception("Hour {$hour} is already booked.");
                }

                $start = Carbon::parse("{$this->selectedDate} {$hour}");
                $end   = $start->copy()->addHour();

                $rentService->createProductRentForUser([
                    'product_id' => $this->selectedProduct,
                    'start_time' => $start,
                    'end_time'   => $end,
                    'payment_method' => 'cash',
                ], Auth::user());
            }

            session()->flash('successMessage', 'All selected hours were booked successfully!');
            return redirect()->route('rents.index');
        } catch (\Exception $e) {
            $this->addError('bookingError', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.rent.create-rent');
    }
}
