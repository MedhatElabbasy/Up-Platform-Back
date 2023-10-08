<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\CourseService;
use App\Http\Services\CategoryService;

class CourseController extends Controller
{
    public function __construct(
        private CourseService $courseService,
        private CategoryService $categoryService,
    ) {}

    public function index(){
        $courses = $this->courseService->getAllCourses();

        return view('dashboard.courses.index', compact('courses'));
    }

    public function create(){
        $categories = $this->categoryService->getAllCategories();

        return view('dashboard.courses.create', compact('categories'));
    }

    public function store(){
        $this->courseService->addCourse([
            'name' => request()->name,
            'description' => request()->description,
            'price' => request()->price,
            'category_id' => request()->category,
        ]);

        return redirect()->back()->with('message', 'تم الاضافة بنجاح');
    }
    
    public function edit($id){
        $course = $this->courseService->getCourseById($id);
        $categories = $this->categoryService->getAllCategories();

        return view('dashboard.courses.edit', compact('course', 'categories'));
    }
    
    public function update($id){
        $this->courseService->getCourseById($id)->update([
            'name' => request()->name,
            'description' => request()->description,
            'price' => request()->price,
            'category_id' => request()->category,
        ]);

        return redirect()->back()->with('message', 'تم التحديث بنجاح');
    }

    public function destroy($id)
    {
        $this->courseService->getCourseById($id)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}


