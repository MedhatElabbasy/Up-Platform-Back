<?php

namespace App\Http\Controllers\Api\Servicess\community;

use App\Http\Controllers\Controller;
use Modules\Blog\Entities\Blog;

class CommunityApiController extends Controller
{

    public function index()
    {
        // $blogs = Blog::select('title','description','image')->get();
        // $blogs = Blog::with('user:name')->select('title', 'description', 'image')->get();/
        $blogs = Blog::with('user:,name')->select('title', 'description', 'image')->get();

        return response()->json($blogs, 200);
    }

}