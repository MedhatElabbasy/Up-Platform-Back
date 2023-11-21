<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::where('user_id', auth()->user()->id)->get();

        return response()->json([
            'success' => true,
            'data' => $projects
        ]);
    }

    public function store(Request $request){
        // Validate
        $rules = [
            'name' => 'required|string|min:2',
            'category_id'=> 'sometimes|integer|exists:project_categories,id',
            'subcategory_id'=> 'sometimes|integer|exists:project_subcategories,id',
        ];

        $this->validate($request, $rules, validationMessage($rules));

        // Create project
        $project = Project::create([
            "user_id" => auth()->user()->id,
            "name" => $request->name,
            "project_category_id" => $request->category_id,
            "project_subcategory_id" => $request->subcategory_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
            'data' => $project
        ]);
    }

    public function show(Request $request, $project_id){
        $project = Project::findOrFail($project_id);

        return response()->json([
            'success' => true,
            'data' => $project,
        ]);
    }

    public function update(Request $request, $project_id){
        // Validate
        $rules = [
            'name' => 'required|string|min:2',
            'category_id'=> 'sometimes|integer|exists:project_categories,id',
            'subcategory_id'=> 'sometimes|integer|exists:project_subcategories,id',
        ];

        $this->validate($request, $rules, validationMessage($rules));

        // Update project
        $project = Project::findOrFail($project_id);

        $project->name = $request->name;

        if(!empty($request->category_id))
            $project->project_category_id = $request->category_id;

        if(!empty($request->subcategory_id))
            $project->project_subcategory_id = $request->subcategory_id;

        $project->save();

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
        ]);
    }

    public function destroy($project_id){
        $project = Project::findOrFail($project_id);
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
        ]);
    }
}
