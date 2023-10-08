<?php

namespace App\Http\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function getAllCourses()
    {
        return Course::get();
    }

    public function addCourse($data)
    {
        return Course::create($data);
    }

    public function getCourseById($id)
    {
        return Course::findOrFail($id);
    }
}
