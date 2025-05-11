<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Groceries',
            'Home Appliances',
            'Fashion',
            'Books',
            'Toys',
            'Health & Beauty',
            'Sports & Outdoors',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
