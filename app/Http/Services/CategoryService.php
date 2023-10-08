<?php

namespace App\Http\Services;

use App\Http\Services\Service;
use App\Http\Repositories\CategoryRepository;

class CategoryService extends Service
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ){}

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function addCategory($data)
    {
        return $this->categoryRepository->addCategory($data);
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }
}

