<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\LessonService;
use App\Http\Services\SectionService;

class LessonController extends Controller
{
    public function __construct(
        private LessonService $lessonService,
        private SectionService $sectionService,
    ) {}

    public function index($section_id){
        $lessons = $this->lessonService->getAllLessonsBySectionId($section_id);

        return view('dashboard.lessons.index', compact('section_id', 'lessons'));
    }

    public function create($section_id){
        $section = $this->sectionService->getSectionById($section_id);

        return view('dashboard.lessons.create', compact('section'));
    }

    public function store($section_id){
        $this->lessonService->addLesson([
            'name' => request()->name,
            'description' => request()->description,
            'section_id' => $section_id
        ], request()->file('file'));
        
        return redirect()->back()->with('message', 'تم الاضافة بنجاح');
    }
    
    public function edit($section_id, $id){
        $lesson = $this->lessonService->getLessonById($id);
        $section = $this->sectionService->getSectionById($section_id);

        return view('dashboard.lessons.edit', compact('lesson', 'section'));
    }
    
    public function update($course_id, $id){
        $this->lessonService->getLessonById($id)->update([
            'name' => request()->name,
            'description' => request()->description,
        ]);

        return redirect()->back()->with('message', 'تم التحديث بنجاح');
    }

    public function destroy($course_id, $id)
    {
        $this->lessonService->deleteLessonById($id);

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}


