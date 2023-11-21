<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectMarktingProduct;

class ProjectMarktingProductController extends Controller
{

    public function index($project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);
        $products = $project->marktingProducts()->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function store(Request $request, $project_id){
        $project = Project::where('user_id', auth()->user()->id)->findOrFail($project_id);
        $product = $project->marktingProducts()->create([
            "project_id" => $project_id,
            "name" => $request->name,
            "quantity" => $request->quantity,
            "price" => $request->price,
            "profit" => $request->profit,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
            'data' => $product
        ]);
    }

    public function update(Request $request, $product_id){
        $product = ProjectMarktingProduct::findOrFail($product_id);
        Project::where('user_id', auth()->user()->id)->findOrFail($product->project_id);

        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->profit = $request->profit;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
            'data' => $product
        ]);
    }

    public function destroy($product_id){
        $product  = ProjectMarktingProduct::findOrFail($product_id);
        Project::where('user_id', auth()->user()->id)->findOrFail($product->project_id);
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Operation Successful',
        ]);
    }
}
