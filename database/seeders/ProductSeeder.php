<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Apple MacBook Air M2', 'price' => 1199.99, 'stock' => 15],
            ['name' => 'Samsung Galaxy S23 Ultra', 'price' => 999.99, 'stock' => 20],
            ['name' => 'Sony PlayStation 5', 'price' => 499.99, 'stock' => 10],
            ['name' => 'Apple AirPods Pro (2nd Gen)', 'price' => 249.99, 'stock' => 30],
            ['name' => 'Dell XPS 13', 'price' => 1299.99, 'stock' => 12],
            ['name' => 'Bose QuietComfort 45 Headphones', 'price' => 329.99, 'stock' => 25],
            ['name' => 'Logitech MX Master 3 Mouse', 'price' => 99.99, 'stock' => 50],
            ['name' => 'Nintendo Switch OLED', 'price' => 349.99, 'stock' => 18],
            ['name' => 'Samsung 55" 4K Smart TV', 'price' => 699.99, 'stock' => 8],
            ['name' => 'Canon EOS R5 Mirrorless Camera', 'price' => 3799.99, 'stock' => 5],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
