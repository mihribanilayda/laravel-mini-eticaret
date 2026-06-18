<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
    [
        'name' => 'iPhone 15',
        'slug' => 'iphone-15',
        'description' => 'Apple iPhone 15 128GB',
        'price' => 45000.00,
        'stock' => 10,
        'category_id' => 1,
    ],
    [
        'name' => 'Samsung Galaxy S24',
        'slug' => 'samsung-galaxy-s24',
        'description' => 'Samsung Galaxy S24 256GB',
        'price' => 38000.00,
        'stock' => 15,
        'category_id' => 1,
    ],
    [
        'name' => 'Koşu Ayakkabısı',
        'slug' => 'kosu-ayakkabisi',
        'description' => 'Nike Air Max koşu ayakkabısı',
        'price' => 2500.00,
        'stock' => 20,
        'category_id' => 4,
    ],
    [
        'name' => 'Laravel Up Running',
        'slug' => 'laravel-up-running',
        'description' => 'Laravel öğrenmek için en iyi kitap',
        'price' => 350.00,
        'stock' => 50,
        'category_id' => 3,
    ],
];

foreach ($products as $product) {
    \App\Models\Product::create($product);
}
    }
}
