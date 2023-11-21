<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use App\Models\Opportunity_Category;

class OpportunityCategoryWebController extends Controller
{
    public function index()
    {
        $categories = Opportunity_Category:: orderBy('id', 'desc')
        ->get();
        return view('opportunity.category.index', compact('categories'));
    }

    public function create()
    {
        return view('opportunity.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'opp_cat_name' => 'required',
            'opp_cat_desc' => 'required',
        ]);

        Opportunity_Category::create($request->all());

        return redirect()->route('opportunity-categories.index')
            ->with('success', 'تم إنشاء تصنيف الفرصة بنجاح');
    }

    public function show(Opportunity_Category $category)
    {
        return view('opportunity_categories.show', compact('category'));
    }

    public function edit(Opportunity_Category $category)
    {

        return view('opportunity.category.edit', compact('category'));
    }

    public function update(Request $request, Opportunity_Category $category)
    {
        $request->validate([
            'opp_cat_name' => 'required',
            'opp_cat_desc' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('opportunity-categories.index')
            ->with('success', 'تم تحديث تصنيف الفرصة بنجاح');
    }

    public function destroy(Opportunity_Category $category)
    {
        $category->delete();

        return redirect()->route('opportunity-categories.index')
            ->with('success', 'تم حذف تصنيف الفرصة بنجاح');
    }
}