<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectLesson;
use Illuminate\Http\Request;

class ProjectLessonController extends Controller
{
    public function index(Request $request){
        $lessons = (empty($request->type)) ? ProjectLesson::get() : ProjectLesson::where('type', $request->type)->get();

        return response()->json([
            'success' => true,
            'data' => $lessons,
        ]);
    }

    public function show(Request $request, $id){
        $lesson = ProjectLesson::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $lesson,
        ]);
    }
}
