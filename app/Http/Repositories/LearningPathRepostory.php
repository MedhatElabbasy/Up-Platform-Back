<?php

namespace App\Http\Repositories;

use App\Models\LearningPath;

class LearningPathRepostory
{
    public function getAllLearningPath()
    {
        return LearningPath::get();
    }

    public function addLearningPath($data)
    {
        return LearningPath::create($data);
    }

    public function getLearningPathById($id)
    {
        return LearningPath::findOrFail($id);
    }
}