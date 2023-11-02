<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BundleSubscription\Repositories\BundleCoursePlanRepository;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Illuminate\Support\Facades\Auth;

class BundleSubscriptionApiController extends Controller
{
    protected $bundleCourse;

    public function __construct(BundleCoursePlanRepository $bundleCourse)
    {
        $this->bundleCourse = $bundleCourse;
    }


    public function index(Request $request)
    {
        $BundleCourse = $this->bundleCourse->getAllActive()
        ->map(function($i) {
            $i->points = $i->price /2;

            return $i;
        });
    
        return response()->json([
            'success' => true,
            "data" => $BundleCourse,
            "count" => count($BundleCourse)
        ]);
    }
    
    public function show($bundle_id)
    {
        $course = $this->bundleCourse->get($bundle_id);
        $course->points = $course->price /2;
        
        if(Auth::User()){
            $isEnrolled = CourseEnrolled::where('user_id', Auth::id())->where('bundle_course_id', $request->id)->first();
        }else{
            $isEnrolled = false;
        }
        
        return response()->json([
            'success' => true,
            "data" => $course,
            "is_enrolled" => $isEnrolled
        ]);
    }
}