<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category_id' => 1, 'name' => 'iPhone 14', 'slug' => 'iphone-14', 'description' => 'Apple iPhone 14 128GB', 'price' => 799.99, 'stock' => 10, 'is_featured' => true],
            ['category_id' => 1, 'name' => 'Samsung Galaxy S23', 'slug' => 'samsung-galaxy-s23', 'description' => 'Samsung Galaxy S23 256GB', 'price' => 699.99, 'stock' => 8, 'is_featured' => true],
            ['category_id' => 1, 'name' => 'Laptop Dell XPS', 'slug' => 'laptop-dell-xps', 'description' => 'Dell XPS 15 Intel i7', 'price' => 1299.99, 'stock' => 5, 'is_featured' => true],
            ['category_id' => 2, 'name' => 'Zimska jakna', 'slug' => 'zimska-jakna', 'description' => 'Topla zimska jakna unisex', 'price' => 89.99, 'stock' => 20, 'is_featured' => false],
            ['category_id' => 2, 'name' => 'Sportske patike', 'slug' => 'sportske-patike', 'description' => 'Nike Air Max 2024', 'price' => 129.99, 'stock' => 15, 'is_featured' => true],
            ['category_id' => 3, 'name' => 'Clean Code', 'slug' => 'clean-code', 'description' => 'Robert C. Martin', 'price' => 29.99, 'stock' => 30, 'is_featured' => false],
            ['category_id' => 3, 'name' => 'Laravel Up Running', 'slug' => 'laravel-up-running', 'description' => 'Matt Stauffer', 'price' => 39.99, 'stock' => 12, 'is_featured' => false],
            ['category_id' => 4, 'name' => 'Fudbalska lopta', 'slug' => 'fudbalska-lopta', 'description' => 'Adidas Champions League lopta', 'price' => 49.99, 'stock' => 25, 'is_featured' => false],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}