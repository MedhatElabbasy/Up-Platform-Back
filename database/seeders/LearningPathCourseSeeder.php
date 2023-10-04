<?php

namespace Database\Seeders;

use App\Models\LearningPathCourse;
use Illuminate\Database\Seeder;

class LearningPathCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LearningPathCourse::create([
            'course_id' => 1,
            'learning_path_id' => 1,
        ]);
        LearningPathCourse::create([
            'course_id' => 2,
            'learning_path_id' => 2,
        ]);
    }
}