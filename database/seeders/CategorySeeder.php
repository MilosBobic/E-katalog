<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronika', 'slug' => 'elektronika', 'description' => 'Telefoni, laptopovi, televizori'],
            ['name' => 'Odeca', 'slug' => 'odeca', 'description' => 'Muska i zenska odeca'],
            ['name' => 'Knjige', 'slug' => 'knjige', 'description' => 'Strucna literatura i romani'],
            ['name' => 'Sport', 'slug' => 'sport', 'description' => 'Sportska oprema i rekviziti'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}