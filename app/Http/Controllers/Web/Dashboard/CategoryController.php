<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService,
    ) {}

    public function index(){
        $categories = $this->categoryService->getAllCategories();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create(){
        return view('dashboard.categories.create');
    }

    public function store(){
        $this->categoryService->addCategory([
            'name' => request()->name,
            'description' => request()->description,
        ]);

        return redirect()->back()->with('message', 'تم الاضافة بنجاح');
    }
    
    public function edit($id){
        $category = $this->categoryService->getCategoryById($id);

        return view('dashboard.categories.edit', compact('category'));
    }
    
    public function update($id){
        $this->categoryService->getCategoryById($id)->update([
            'name' => request()->name,
            'description' => request()->description,
        ]);

        return redirect()->back()->with('message', 'تم التحديث بنجاح');
    }

    public function destroy($id)
    {
        $this->categoryService->getCategoryById($id)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}


