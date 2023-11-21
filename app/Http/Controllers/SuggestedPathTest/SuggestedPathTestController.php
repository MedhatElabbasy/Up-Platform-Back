<?php

namespace App\Http\Controllers\SuggestedPathTest;

use App\Models\SuggestedPathTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\SuggestedPathTestSetting;

class SuggestedPathTestController extends Controller
{
    public function settings(){
        $settings = SuggestedPathTestSetting::first();

        return view('backend.suggested_path_test.settings', compact('settings'));
    }

    public function settings_update(Request $request){
        SuggestedPathTestSetting::first()->update([
            "minutes" => $request->minutes,
            "qualification_path_points" => $request->qualification_path_points,
            "empowerment_path_points" => $request->empowerment_path_points,
            "e_commerce_path_points" => $request->e_commerce_path_points,
        ]);

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return back();
    }

    public function index(Request $request){
        $test = SuggestedPathTest::with('answers')->get();

        return view('backend.suggested_path_test.index', compact('test'));
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
        $test = SuggestedPathTest::findOrFail($id);

        return view('backend.suggested_path_test.edit', compact('test'));
    }

    public function update(Request $request, $id){
        $test = SuggestedPathTest::findOrFail($id);
        $test->update([
            "question" => $request->question
        ]);

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return back();
    }

}
