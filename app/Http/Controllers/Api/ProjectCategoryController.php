<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;

class ProjectCategoryController extends Controller
{
    public function index(){
        $categories = ProjectCategory::get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    function show($id){
        $category = ProjectCategory::with('subcategories')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }
}
