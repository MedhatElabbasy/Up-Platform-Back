<?php

namespace Database\Seeders;

use App\Models\LearningPath;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LearningPath::create([
            'name' => 'المسار الأول ',
            'description' => fake()->text(),
            'price' => 10.99,
            'category_id' => 1,
        ]);
        LearningPath::create([
            'name' => 'المسار الثاني ',
            'description' => fake()->text(),
            'price' => 15.5,
            'category_id' => 1,
        ]);

    }
}