<x-layouts.app :title="__('Rent & Play')">
    <flux:heading size="xl" level="1">🎮 Play. Compete. Repeat!</flux:heading>

    <flux:subheading size="lg" class="mb-6">No console? No problem! Rent and play on-site—no setup, just pure
        gaming fun. Grab a controller and jump in! 🚀🔥</flux:subheading>

    <flux:separator variant="subtle" class="mb-6" />

    <livewire:common.product.product-list :products="$products" />


    <flux:input wire:model="username" label="Username" description="This will be publicly displayed." />

</x-layouts.app>
