<?php

namespace App\Http\Controllers\Simulation;

use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use App\Models\SuggestedPathTest;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SimulationCategoryController extends Controller
{
    public function index(Request $request){
        $categories = ProjectCategory::get();

        return view('backend.simulation_categories.index', compact('categories'));
    }

    public function store(Request $request){
        SuggestedPathTest::create([
            'question' => $request->question
        ]);

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return back();
    }

    public function delete(Request $request){
        $test = SuggestedPathTest::findOrFail($request->id);
        $test->delete();

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return back();
    }

    public function edit($id){
        $test = SuggestedPathTest::FindOrFail($id);

        return view('backend.suggested_path_test.edit', compact('test'));
    }

    public function update(Request $request, $id){
        $test = SuggestedPathTest::FindOrFail($id);
        $test->update([
            "question" => $request->question
        ]);

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return back();
    }

}
