<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\CourseSetting\Entities\Course;
use Modules\BundleSubscription\Entities\BundleCourse;

class RedirectController extends Controller
{
    public function redirectToUrl($user_id, $path='/', $key='YSpkMjFxS5EELVmF')
    {
        if($key!='YSpkMjFxS5EELVmF')
            return "Error!";

        // Find user
        $user = User::findOrFail($user_id);

        // Login
        Auth::login($user);

        // Redirect to website
        return redirect($path);
    }

    public function redirectToWebsite($user_id, $url)
    {
        return $this->redirectToUrl($user_id);
    }

    public function redirectToCourse(Request $request)
    {
        switch ($request->course_category) {
            case 'skills_library':
                $course = Course::findOrFail($request->course_id);
                $url = 'continue-course/'.$course->slug;
                break;
            case 'online_courses':
                $course = Course::findOrFail($request->course_id);
                $url = 'continue-course/'.$course->slug;
                break;
            case 'training_paths':
                $course = BundleCourse::findOrFail($request->course_id);
                $url = 'bundle-subscription/bundle/course-list?id='.$course->id;
                break;
            default:
                $course = Course::findOrFail($request->course_id);
                $url = 'continue-course/'.$course->slug;
                break;
        }

        return $this->redirectToUrl($request->user_id, $url);
    }
}
