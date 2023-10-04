<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'تكنولوجا',
            'description' => fake()->text(),
        ]);
        Category::create([
            'name' => 'اقتصاد',
            'description' => fake()->text(),
        ]);
    }
}