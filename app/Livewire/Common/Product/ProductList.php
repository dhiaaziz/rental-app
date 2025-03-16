<?php

namespace App\Livewire\Common\Product;

use Livewire\Component;

class ProductList extends Component
{
    public array $products = [];
    public ?int $selectedProductId = null; // Default to null

    protected $listeners = ['productSelected'];

    public function productSelected($productId)
    {
        // Allow only one product to be selected at a time
        $this->selectedProductId = $productId;
    }

    public function render()
    {
        return view('livewire.common.product.product-list', [
            'selectedProductId' => $this->selectedProductId,
        ]);
    }
}
