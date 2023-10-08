<?php

namespace App\Http\Services;

use App\Http\Services\Service;
use App\Http\Repositories\SectionRepository;

class SectionService extends Service
{
    public function __construct(
        private SectionRepository $sectionRepository
    ){}

    public function getAllSectionsByCourseId($course_id)
    {
        return $this->sectionRepository->getAllSectionsByCourseId($course_id);
    }

    public function addSection($data)
    {
        return $this->sectionRepository->addSection($data);
    }

    public function getSectionById($id)
    {
        return $this->sectionRepository->getSectionById($id);
    }
}

