<?php

namespace App\Http\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    public function getAllLessonsBySectionId($section_id)
    {
        return Lesson::where('section_id', $section_id)->get();
    }

    public function addLesson($data)
    {
        return Lesson::create($data);
    }

    public function getLessonById($id)
    {
        return Lesson::findOrFail($id);
    }
}
