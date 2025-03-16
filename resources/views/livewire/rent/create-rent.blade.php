<div class="max-w-md mx-auto p-4"
     x-data="rentData($wire, @js($products))"
     x-init="initState()"
>
    <h1 class="text-2xl font-bold mb-4">Create Rent</h1>

    @if(session()->has('successMessage'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('successMessage') }}
        </div>
    @endif

    @error('bookingError')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ $message }}
        </div>
    @enderror

    <form wire:submit.prevent="createRents" class="space-y-4">

        {{-- Select Product --}}
        <div>
            <label class="block font-semibold mb-1">Select Product</label>
            <select
                class="border p-2 w-full rounded"
                x-model="selectedProduct"
                @change="handleChange"
            >
                <option value="">-- Choose Product --</option>
                <template x-for="p in products" :key="p.id">
                    <option :value="p.id" x-text="p.name"></option>
                </template>
            </select>
            @error('selectedProduct')
                <span class="text-red-600 block mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Select Date --}}
        <div>
            <label class="block font-semibold mb-1">Select Date</label>
            <input
                type="date"
                class="border p-2 w-full rounded"
                x-model="selectedDate"
                @change="handleChange"
            />
            @error('selectedDate')
                <span class="text-red-600 block mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Select Hours (Multiple) --}}
        <div>
            <label class="block font-semibold mb-1">Select Hours (multiple)</label>
            <select
                wire:model="selectedHours"
                multiple
                class="border p-2 w-full rounded h-32"
                {{-- disable if no product/date selected in Alpine --}}
                :disabled="!selectedProduct || !selectedDate"
                x-ref="hoursSelect"
            >
                @foreach($availableHours as $hour)
                    <option
                        value="{{ $hour }}"
                        @if(in_array($hour, $unavailableHours))
                            disabled
                            style="background-color: #e5e7eb; color: #9ca3af;"
                        @endif
                    >
                        {{ $hour }}
                        @if(in_array($hour, $unavailableHours))
                            (unavailable)
                        @endif
                    </option>
                @endforeach
            </select>
            @error('selectedHours')
                <span class="text-red-600 block mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save Rent
        </button>
    </form>
</div>

{{-- Alpine JS script --}}
<script>
    function rentData($wire, products) {
        return {
            products: products,         // array of products from the controller
            selectedProduct: '',        // track in Alpine
            selectedDate: '',

            initState() {
                // If you want to default from Livewire's old values, do so here
                // e.g. this.selectedProduct = @entangle('selectedProduct');
                // but typically we'll store them just in Alpine
            },

            handleChange() {
                // Called when product or date changes
                if (this.selectedProduct && this.selectedDate) {
                    // Call the Livewire method, pass in selected
                    $wire.checkAvailability(this.selectedProduct, this.selectedDate);
                } else {
                    // If incomplete, call with empty to clear
                    $wire.checkAvailability('', '');
                }
            },
        }
    }
</script>
