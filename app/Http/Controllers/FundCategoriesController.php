<?php

namespace App\Http\Controllers;

use App\Models\Fund_Categories;
use Illuminate\Http\Request;

class FundCategoriesController extends Controller
{
    public function index()
    {
        $fundCategories = Fund_Categories::all();
        return view('community.category.index', compact('fundCategories'));
    }

    public function create()
    {
        return view('community.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fund_categories_name' => 'required',
        ]);

        Fund_Categories::create($request->all());

        return redirect()->route('fund-categories.index')
            ->with('success', 'Fund category created successfully');
    }

    public function show(Fund_Categories $fundCategory)
    {
        return view('fund_categories.show', compact('fundCategory'));
    }

    public function edit(Fund_Categories $fundCategory)
    {
        return view('community.category.edit', compact('fundCategory'));
    }

    public function update(Request $request, Fund_Categories $fundCategory)
    {
        $request->validate([
            'fund_categories_name' => 'required',
        ]);

        $fundCategory->update($request->all());

        return redirect()->route('fund-categories.index')
            ->with('success', 'Fund category updated successfully');
    }

    public function destroy(Fund_Categories $fundCategory)
    {
        $fundCategory->delete();

        return redirect()->route('fund-categories.index')
            ->with('success', 'Fund category deleted successfully');
    }
}