<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectCaseStudyController extends Controller
{
    public function index(Request $request, $project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);
        $notes = $project->caseStudy;

        return response()->json([
            'success' => true,
            'data' => $notes,
        ]);
    }

    public function store(Request $request, $project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);

        $project->caseStudy()->updateOrCreate(
            [
                'project_id'=> $project_id,
            ],
            [
                "project_id"=> $project_id,
                "capital_cost" =>  $request->capital_cost,
                "loan_interest_percentage" =>  $request->loan_interest_percentage,
                "salary_per_year" =>  $request->salary_per_year,
                "rent_per_year" =>  $request->rent_per_year,
                "purchases_cost_per_year" =>  $request->purchases_cost_per_year,
                "decor_cost_per_month" =>  $request->decor_cost_per_month,
                "marketing_cost" =>  $request->marketing_cost,
                "additional_costs" =>  ($request->additional_costs > (($request->capital_cost) * (10/100))) ? (($request->capital_cost) * (10/100)) : $request->additional_costs,
                "government_fees" =>  $request->government_fees,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
        ]);
    }
}
