<?php

namespace App\Http\Controllers;

use App\Models\CurancyExchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CapController extends Controller
{
    public function index()
    {

         $currencyExchange = CurancyExchange::first();

        $valueByCap = $currencyExchange->value_by_cap;
        return view('cap-price',compact('valueByCap'));
    }
//store currency
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currency' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        if ($validator->fails()) {
            //
            return redirect()->back()->withErrors($validator)->withInput();
        }
          
          
          $currencyExchange = CurancyExchange::firstOrCreate(
            [],
            ['value_by_cap' => $request->input('currency')]
        );

        // Update the value if the row already exists
        if (!$currencyExchange->wasRecentlyCreated) {
            $currencyExchange->update(['value_by_cap' => $request->input('currency')]);
        }
        
         return redirect()->route('CapPrice');


    }
}

// , compact('badges', 'recentEnroll', 'courshEarningM_onth_name', 'courshEarningMonthly', 'payment_statistics', 'enroll_day', 'enroll_count', 'course_overview', 'allCourses', 'students')