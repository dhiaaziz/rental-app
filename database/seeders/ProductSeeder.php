<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(['name' => 'MacBook Pro', 'price' => 2500.00]);
        Product::create(['name' => 'iPad Air', 'price' => 799.99]);
    }
}
