<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectPointController extends Controller
{
    public function index($project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);
        $points = $project->points()->first();

        return response()->json([
            'success' => true,
            'data' => $points
        ]);
    }

    public function store(Request $request, $project_id){
        // Prepare points
        $points = [];

        foreach ([
        'strength',
        'opportunities',
        'weaknesses',
        'threats'
        ] as $key) {
            foreach ([
            "point_1",
            "point_2",
            "point_3",
            "point_4",
            "point_5",
            ] as $point_name) {
                $points[$key][$point_name] = [
                    "name" => $request->points[$key][$point_name]['name']??null,
                    "value" => $request->points[$key][$point_name]['value']??null,
                ];
            }
        }

        // Store
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);

        $project->points()->updateOrCreate(
            [
                'project_id' => $project_id,
            ],
            [
                "project_id" => $project_id,
                "points" => $points
            ]
        );

        // Next step
        $project->update([
            "current_step" => "strength"
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
        ]);
    }
}



