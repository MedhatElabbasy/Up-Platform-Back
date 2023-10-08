<?php

namespace App\Http\Services;

use App\Http\Services\Service;
use App\Http\Repositories\CourseRepository;

class CourseService extends Service
{
    public function __construct(
        private CourseRepository $courseRepository
    ){}

    public function getAllCourses()
    {
        return $this->courseRepository->getAllCourses();
    }

    public function addCourse($data)
    {
        return $this->courseRepository->addCourse($data);
    }

    public function getCourseById($id)
    {
        return $this->courseRepository->getCourseById($id);
    }
}

