<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\ProjectPurchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectPurchaseController extends Controller
{
    public function index($project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);
        $purchases = $project->purchases()->get();

        return response()->json([
            'success' => true,
            'data' => $purchases
        ]);
    }

    public function store(Request $request, $project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);
        $purchase = $project->purchases()->create([
            "project_id" => $project_id,
            "name" => $request->name,
            "cost" => $request->cost,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
            'data' => $purchase
        ]);
    }

    public function update(Request $request, $purchase_id){
        $purchase  = ProjectPurchase::findOrFail($purchase_id);
        Project::where('user_id', auth()->user()->id)->findOrFail($purchase->project_id);

        $purchase->name = $request->name;
        $purchase->cost = $request->cost;
        $purchase->save();

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
            'data' => $purchase
        ]);
    }

    public function destroy($purchase_id){
        $purchase  = ProjectPurchase::findOrFail($purchase_id);
        Project::where('user_id', auth()->user()->id)->findOrFail($purchase->project_id);
        $purchase->delete();

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
        ]);
    }
}
