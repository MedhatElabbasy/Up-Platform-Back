<?php

namespace App\Http\Repositories;

use App\Models\Section;

class SectionRepository
{
    public function getAllSectionsByCourseId($course_id)
    {
        return Section::where('course_id', $course_id)->get();
    }

    public function addSection($data)
    {
        return Section::create($data);
    }

    public function getSectionById($id)
    {
        return Section::findOrFail($id);
    }
}
