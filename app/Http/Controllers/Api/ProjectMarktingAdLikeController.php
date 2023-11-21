<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectMarketingAds;
use App\Http\Controllers\Controller;

class ProjectMarktingAdLikeController extends Controller
{
    public function store(Request $request, $ad_id){
        $ad = ProjectMarketingAds::findOrFail($ad_id);

        $ad->likes()->updateOrCreate(
        [
            "user_id" => auth()->user()->id
        ],
        [
            "user_id" => auth()->user()->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Send like',
        ]);
    }

    public function destroy(Request $request, $ad_id){
        $ad = ProjectMarketingAds::findOrFail($ad_id);

        $ad->likes()->where('user_id', auth()->user()->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Remove like',
        ]);
    }

    public function toggle(Request $request, $ad_id){
        $ad = ProjectMarketingAds::findOrFail($ad_id);
        Project::where('user_id', auth()->user()->id)->findOrFail($ad->project_id);

        if($ad->likes()->where('user_id', auth()->user()->id)->exists())
            return $this->destroy($request, $ad_id);

        return $this->store($request, $ad_id);
    }

}
