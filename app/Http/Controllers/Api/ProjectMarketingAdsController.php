<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\ProjectMarketingAds;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectMarktingProduct;

class ProjectMarketingAdsController extends Controller
{
    public function index($project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);
        $products = $project->marktingAds()->with('likes')->where('created_at', '>', now()->subDay())->get();
        $products->map(function ($product) {
            $product->image_link = asset('public/'.$product->image);
            $product->video_link = asset('public/'.$product->video);
            $product->status = $product->created_at->addDay() > now();
        });

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function store(Request $request, $product_id){
        $product = ProjectMarktingProduct::findOrFail($product_id);
        Project::where('user_id', auth()->user()->id)->findOrFail($product->project_id);

        // Upload files
        $dir = 'uploads/ads';

        if (!file_exists($dir))
            mkdir($dir, 0777, true);

        // Upload image
        $fileName = time() . "." . $request->image->getClientOriginalExtension();
        $request->image->move('public'.DIRECTORY_SEPARATOR.$dir, $fileName);
        $image_file_name = $dir.DIRECTORY_SEPARATOR.$fileName;

        // Upload video
        $fileName = time() . "." . $request->video->getClientOriginalExtension();
        $request->video->move('public'.DIRECTORY_SEPARATOR.$dir, $fileName);
        $video_file_name = $dir.DIRECTORY_SEPARATOR.$fileName;

        // Store in database
        $ad_uniq_id = uniqid("ad-").time();
        $ad = $product->marktingAds()->create([
            "image" => $image_file_name,
            "video" => $video_file_name,
            "project_id" => $product->project_id,
            "marketing_product_id" => $product_id,
            "link" => $ad_uniq_id,
        ]);

        $ad->image_link = asset('public/'.$ad->image);
        $ad->video_link = asset('public/'.$ad->video);

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
            'data' => $ad
        ]);
    }

    public function update(Request $request, $ad_id){
        $ad = ProjectMarketingAds::findOrFail($ad_id);
        Project::where('user_id', auth()->user()->id)->findOrFail($ad->project_id);

        // Upload files
        $dir = 'uploads/ads';

        if (!file_exists($dir))
            mkdir($dir, 0777, true);

        // Upload image
        if($request->hasFile('image')){
            try {
                unlink(public_path($ad->image));
            } catch (\Throwable $th) {}

            $fileName = time() . "." . $request->image->getClientOriginalExtension();
            $request->image->move('public'.DIRECTORY_SEPARATOR.$dir, $fileName);
            $ad->image = $dir.DIRECTORY_SEPARATOR.$fileName;
        }

        // Upload video
        if($request->hasFile('video')){
            try {
                unlink(public_path($ad->video));
            } catch (\Throwable $th) {}

            $fileName = time() . "." . $request->video->getClientOriginalExtension();
            $request->video->move('public'.DIRECTORY_SEPARATOR.$dir, $fileName);
            $ad->video = $dir.DIRECTORY_SEPARATOR.$fileName;
        }

        // Store in database
        $ad->save();

        $ad->image_link = asset('public/'.$ad->image);
        $ad->video_link = asset('public/'.$ad->video);

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
            'data' => $ad
        ]);
    }

    public function destroy(Request $request, $product_id){
        $ad = ProjectMarketingAds::findOrFail($product_id);
        Project::where('user_id', auth()->user()->id)->findOrFail($ad->project_id);

        try {
            unlink(public_path($ad->image));
            unlink(public_path($ad->video));
        } catch (\Throwable $th) {}

        $ad->delete();

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
        ]);
    }

    public function show(Request $request, $slug){
        $ad = ProjectMarketingAds::where('link', $slug)->with('likes')->firstOrFail();
        Project::where('user_id', auth()->user()->id)->findOrFail($ad->project_id);

        $ad->profit = $ad->likes->count() * 12;
        $ad->status = $ad->created_at->addDay() > now();

        return response()->json([
            'success' => true,
            'data' => $ad,
        ]);
    }
}
