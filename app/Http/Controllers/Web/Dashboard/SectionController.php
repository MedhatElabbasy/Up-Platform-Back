<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\CourseService;
use App\Http\Services\SectionService;

class SectionController extends Controller
{
    public function __construct(
        private CourseService $courseService,
        private SectionService $sectionService,
    ) {}

    public function index($course_id){
        $sections = $this->sectionService->getAllSectionsByCourseId($course_id);

        return view('dashboard.sections.index', compact('course_id', 'sections'));
    }

    public function create($course_id){
        $course = $this->courseService->getCourseById($course_id);

        return view('dashboard.sections.create', compact('course'));
    }

    public function store($course_id){
        $this->sectionService->addSection([
            'name' => request()->name,
            'description' => request()->description,
            'course_id' => $course_id
        ]);

        return redirect()->back()->with('message', 'تم الاضافة بنجاح');
    }
    
    public function edit($course_id, $id){
        $section = $this->sectionService->getSectionById($id);

        return view('dashboard.sections.edit', compact('section'));
    }
    
    public function update($course_id, $id){
        $this->sectionService->getSectionById($id)->update([
            'name' => request()->name,
            'description' => request()->description,
            'course_id' => $course_id,
        ]);

        return redirect()->back()->with('message', 'تم التحديث بنجاح');
    }

    public function destroy($course_id, $id)
    {
        $this->sectionService->getSectionById($id)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}


