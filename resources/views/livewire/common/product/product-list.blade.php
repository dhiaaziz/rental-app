<div>
    <h2 class="text-lg font-bold mb-4">Select a Product</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <livewire:common.product.product-card
                :product="$product"
                :isSelected="($selectedProductId === $product['id'])"
                wire:key="product-{{ $product['id'] }}"
            />
        @endforeach
    </div>
</div>
