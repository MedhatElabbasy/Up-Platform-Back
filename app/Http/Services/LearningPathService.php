<?php

namespace App\Http\Services;

use App\Http\Services\Service;
use App\Http\Repositories\LearningPathRepostory;

class LearningPathService extends Service
{
    public function __construct(
        private LearningPathRepostory $learningPathRepository
    ){}

    public function getAllLearningPath()
    {
        return $this->learningPathRepository->getAllLearningPath();
    }

    public function addLearningPath($data)
    {
        return $this->learningPathRepository->addLearningPath($data);
    }

    public function getLearningPathById($id)
    {
        return $this->learningPathRepository->getLearningPathById($id);
    }
}