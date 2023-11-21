<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\Opportunity_Category;
use App\Models\Opportunity_Application;
use Illuminate\Http\Request;

class OpportunityWebController extends Controller
{
    public function index()
    {
        $opportunities = Opportunity::with('category')
        ->orderBy('id', 'desc')
        ->get();
        return view('opportunity.index', compact('opportunities'));
    }

    public function create()
    {
        $categories = Opportunity_Category::all();
        return view('opportunity.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // validation rules here
        ]);

        $opportunity = Opportunity::create($request->all());

        return redirect()->route('opportunities.index')
            ->with('success', 'تم إنشاء الفرصة بنجاح');
    }

    public function show(Opportunity $opportunity)
    {
        return view('opportunity.show', compact('opportunity'));
    }

    public function edit(Opportunity $opportunity)
    {
        $categories = Opportunity_Category::all();
        return view('opportunity.edit', compact('opportunity', 'categories'));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        $request->validate([
            // validation rules here
        ]);

        $opportunity->update($request->all());

        return redirect()->route('opportunities.index')
            ->with('success', 'تم تحديث الفرصة بنجاح');
    }

    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete();

        return redirect()->route('opportunities.index')
            ->with('success', 'تم حذف الفرصة بنجاح');
    }
}