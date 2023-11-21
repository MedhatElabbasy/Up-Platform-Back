<?php

namespace App\Http\Controllers\SuggestedPathTest;

use Illuminate\Http\Request;
use App\Models\SuggestedPathTest;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\SuggestedPathTestAnswer;

class SuggestedPathTestChoiceController extends Controller
{
    public function index(Request $request, $question_id){
        $question = SuggestedPathTest::with('answers')->findOrFail($question_id);

        return view('backend.suggested_path_test.choices.index', compact('question'));
    }

    public function store(Request $request, $question_id){
        $question = SuggestedPathTest::findOrFail($question_id);
        $question->answers()->create([
            "title" => $request->choice,
            "points" => $request->points??0
        ]);

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return back();
    }

    public function delete(Request $request,){
        $choice = SuggestedPathTestAnswer::findOrFail($request->id);
        $choice->delete();

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return back();
    }

    public function edit($id){
        $choice = SuggestedPathTestAnswer::findOrFail($id);

        return view('backend.suggested_path_test.choices.edit', compact('choice'));
    }

    public function update(Request $request, $id){
        $choice = SuggestedPathTestAnswer::findOrFail($id);
        $choice->update([
            "title" => $request->choice,
            "points" => $request->points
        ]);

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return back();
    }

}
