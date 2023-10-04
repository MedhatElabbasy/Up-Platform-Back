<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Course::create([
            'name' => 'Course 1',
            'description' => 'Course 1 description',
            'price' => 9.99,
            'category_id' => 1,
        ]);
        Course::create([
            'name' => 'Course 2',
            'description' => 'Course 2 description',
            'price' => 20.66,
            'category_id' => 2,
        ]);


    }
}