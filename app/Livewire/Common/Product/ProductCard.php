<?php

namespace App\Livewire\Common\Product;

use Livewire\Component;

class ProductCard extends Component
{
    public array $product = [];
    public bool $isSelected = false;

    protected $listeners = ['productSelected' => 'updateSelection'];

    public function selectProduct()
    {
        $this->dispatch('productSelected', $this->product['id']);
    }

    public function updateSelection($productId)
    {
        $this->isSelected = $this->product['id'] === $productId;
    }

    public function render()
    {
        return view('livewire.common.product.product-card');
    }
}
