<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectCaseStudyNoteController extends Controller
{
    public function index(Request $request, $project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);
        $notes = $project->caseStudyNote;

        return response()->json([
            'success' => true,
            'data' => $notes,
        ]);
    }

    public function store(Request $request, $project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);
        $project->caseStudyNote()->updateOrCreate(
            [
                'project_id'=> $project_id,
            ],
            [
                "project_id"=> $project_id,
                "main_partnerships" => $request->main_partnerships,
                "main_activities" => $request->main_activities,
                "added_value" => $request->added_value,
                "customer_relations" => $request->customer_relations,
                "customer_category" => $request->customer_category,
                "main_sub_activities" => $request->main_sub_activities,
                "marketing_channels" => $request->marketing_channels,
                "project_revenue" => $request->project_revenue,
                "project_costs" => $request->project_costs,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
        ]);
    }
}
