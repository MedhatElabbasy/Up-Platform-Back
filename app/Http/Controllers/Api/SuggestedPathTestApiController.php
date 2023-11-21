<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SuggestedPathTest;
use App\Http\Controllers\Controller;
use App\Models\SuggestedPathTestResult;
use App\Models\SuggestedPathTestSetting;

class SuggestedPathTestApiController extends Controller
{
    /*
    * Retive Suggested path test
    *
    */
    public function index(){
        $test = SuggestedPathTest::with('answers')->get();

        $response = [
            'success' => true,
            'data' => $test,
            'count' => count($test),
            'message' => 'Getting test',
        ];

        return response()->json($response, 200);
    }

    /*
    * Get result test of user
    *
    */
    public function show(){
        $minutes = SuggestedPathTestSetting::first()->minutes;

        $test = SuggestedPathTestResult::where('user_id', auth()->user()->id)->first();
        $points = $test?->points;

        $response = [
            'success' => true,
            'passed' => $test && $test->created_at->addMinutes($minutes) < now(),
            'points' => $points,
            'message' => 'Getting result of test',
        ];

        return response()->json($response, 200);
    }

    /*
    * Start test
    *
    */
    public function start(){
        $minutes = SuggestedPathTestSetting::first()->minutes;

        $test = SuggestedPathTestResult::firstOrCreate([
            'user_id'=> auth()->user()->id
        ],[
            'user_id'=> auth()->user()->id,
        ]);

        if($test->created_at->addMinutes($minutes) < now() || !is_null($test->points)){
            $response = [
                'success' => false,
                'message' => 'The exam is end',
            ];

            return response()->json($response, 200);
        }

        $response = [
            'success' => true,
            'day' =>  $test->created_at->format('Y-m-d'),
            'time' => $test->created_at->format('H:i:s'),
            'passed' => $test->created_at->addMinutes($minutes) < now(),
            "message" => "done successfully"
        ];

        return response()->json($response, 200);
    }

    /* 
    * Reset
    * 
    */
   public function reset(Request $request){
        SuggestedPathTestResult::where('user_id', auth()->user()->id)->delete();

        $response = [
            'success' => true,
            "message" => "done successfully"
        ];

        return response()->json($response, 200);
   }

    /*
    * Send answers
    *
    */
    public function store(Request $request){
        $minutes = SuggestedPathTestSetting::first()->minutes;

        $test_result = SuggestedPathTestResult::where('user_id', auth()->user()->id)->first();

        $answers = collect($request->answers)->unique('question_id');
        $questions = $answers->pluck('question_id');
        $test = SuggestedPathTest::whereIn('id', $questions)->with('answers')->get();

        $points = 0;
        foreach ($test as $i)
            $points += $i?->answers->sum('points') ?? 0;

        if(!$test_result){
            $response = [
                'success' => false,
                'message' => 'The exam is not started',
            ];

            return response()->json($response, 200);
        }

        if($test_result->created_at->addMinutes($minutes) < now() || !is_null($test_result->points)){
            $response = [
                'success' => false,
                'message' => 'The exam is end',
            ];

            return response()->json($response, 200);
        }

        SuggestedPathTestResult::where('user_id', auth()->user()->id)->update([
            'points'=> $points,
        ]);

        $response = [
            'success' => true,
            "message" => "done successfully"
        ];

        return response()->json($response, 200);
    }

    /*
    * Get all settings
    *
    */
    public function settings(){
        $settings = SuggestedPathTestSetting::select([
            "minutes",
            "qualification_path_points",
            "empowerment_path_points",
            "e_commerce_path_points"
        ])->first();

        $response = [
            'success' => true,
            'data' => $settings,
            "message" => "Get all settings"
        ];

        return response()->json($response, 200);
    }
}
