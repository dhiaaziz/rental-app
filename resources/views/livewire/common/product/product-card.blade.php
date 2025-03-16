<div
    class="group relative border-2 rounded-md p-2 cursor-pointer transition duration-200 ease-in-out
    {{ $isSelected ? 'border-blue-500 shadow-md' : 'border-gray-300' }}"
    wire:click="selectProduct"
>
    <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="w-full h-40 object-cover rounded-md">

    <div class="mt-2">
        <h3 class="text-sm font-semibold text-gray-700">{{ $product['title'] }}</h3>
        <p class="text-sm text-gray-500">{{ $product['color'] }}</p>
        <p class="text-sm font-medium text-gray-900">${{ $product['price'] }}</p>
    </div>

    @if ($isSelected)
        <div class="absolute top-2 right-2 bg-blue-500 text-white px-2 py-1 text-xs rounded">Selected</div>
    @endif
</div>
