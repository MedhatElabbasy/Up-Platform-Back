<?php

namespace App\Http\Controllers;

use App\Models\Funding_Agency;
use App\Models\Fund_Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FundingAgencyController extends Controller
{
    public function index()
    {
        $fundingAgencies = Funding_Agency::with('fundCategory')
    ->orderBy('id', 'desc')
    ->get();

        return view('community.finance.index', compact('fundingAgencies'));
    }

    public function create()
    {
        $fundCategories = Fund_Categories::all();

        return view('community.finance.create', compact('fundCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fund_name' => 'required',
            'fund_desc' => 'required',
            'fund_rules' => 'required',
            'fund_cost_from' => 'required|numeric',
            'fund_cost_to' => 'required|numeric',
            'fund_repay_period' => 'required',
            'fund_interset_percentage' => 'required|numeric',
            // 'fund_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $fund = new Funding_Agency;
        $fund->fund_name = $request->input('fund_name');
        $fund->fund_desc = $request->input('fund_desc');
        $fund->fund_rules = $request->input('fund_rules');
        $fund->fund_cost_from = $request->input('fund_cost_from');
        $fund->fund_cost_to = $request->input('fund_cost_to');
        $fund->fund_interset_percentage = $request->input('fund_interset_percentage');
        $fund->fund_repay_period = $request->input('fund_repay_period');
        $fund->fund_categories_id = $request->input('fund_categories_id');
        // dd($request->all());

        if ($request->hasFile('fund_logo')) {
            $uploadedImage = $request->file('fund_logo');

            $filename = now()->format('d-m-Y') . '/' . uniqid() . '.' . $uploadedImage->getClientOriginalExtension();

            $fund->fund_logo = 'public/uploads/funding/images/' . $filename;

            $path = 'public/uploads/funding/images/' . now()->format('d-m-Y');
            $uploadedImage->storeAs($path, $filename, 'public');
            $uploadedImage->move($path, $filename);
        }

        // else {
        //     $fund->fund_logo = 'public/uploads/funding/images/defult/null.jpeg';
        // }
        $fund->save();

        return redirect()->route('funding-agencies.index')
            ->with('success', 'تم انشاء التمويل بنجاح');
    }

    public function show(Funding_Agency $fundingAgency)
    {
        return view('funding_agencies.show', compact('fundingAgency'));
    }

    public function edit(Funding_Agency $fundingAgency)
    {
        $fundCategories = Fund_Categories::all();
        return view('community.finance.edit', compact('fundCategories', 'fundingAgency'));
    }

    public function update(Request $request, Funding_Agency $fundingAgency)
    {
        $request->validate([
        ]);


        if ($request->hasFile('fund_logo')) {
            // delete last img
            $oldImagePath = storage_path('app/' . $fundingAgency->fund_logo);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $uploadedImage = $request->file('fund_logo');
            $filename = now()->format('d-m-Y') . '/' . uniqid() . '.' . $uploadedImage->getClientOriginalExtension();
            $newImagePath = 'public/uploads/funding/images/' . $filename;

            $path = 'public/uploads/funding/images/' . now()->format('d-m-Y');
            $uploadedImage->storeAs($path, $filename, 'public');

            $fundingAgency->update(['fund_logo' => $newImagePath]);
        }else{
            $fundingAgency->update($request->except('fund_logo'));

        }


        // else {
        //     $fundingAgency->update(['fund_logo' => $fundingAgency->fund_logo]);
        // }

        return redirect()->route('funding-agencies.index')
            ->with('success', 'تم تعديل التمويل بنجاح');
    }

    public function destroy(Funding_Agency $fundingAgency)
    {
        //last img
        $imagePath = storage_path('app/' . $fundingAgency->fund_logo);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $fundingAgency->delete();

        return redirect()->route('funding-agencies.index')
            ->with('success', 'تم حذف  التمويل بنجاح');
    }
}