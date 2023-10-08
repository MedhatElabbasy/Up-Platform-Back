<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use App\Http\Services\LearningPathService;
use App\Models\LearningPath;
use Illuminate\Http\Request;

class LearningPathController extends Controller
{

    public function __construct(
        private LearningPathService $leaningPathService,
        private CategoryService $categoryService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $paths = $this->leaningPathService->getAllLearningPath();

        return view('dashboard.learningPath.index', compact('paths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('dashboard.learningPath.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $this->leaningPathService->addLearningPath([
            'name' => request()->name,
            'description' => request()->description,
            'price' => request()->price,
            'category_id' => request()->category,
        ]);

        return redirect()->back()->with('message', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(LearningPath $learningPath)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $path = $this->leaningPathService->getLearningPathById($id);
        $categories = $this->categoryService->getAllCategories();

        return view('dashboard.learningPath.edit', compact('path', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $this->leaningPathService->getLearningPathById($id)->update([
            'name' => request()->name,
            'description' => request()->description,
            'price' => request()->price,
            'category_id' => request()->category,
        ]);

        return redirect()->back()->with('message', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->leaningPathService->getLearningPathById($id)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}