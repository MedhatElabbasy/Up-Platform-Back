<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Partnership;
use App\Models\partner_category;
use Illuminate\Http\Request;

class PartnershipWebController extends Controller
{
    public function index()
    {
        $partnerships = Partnership::orderBy('id','desc')->get();
        return view('partnerships.index', compact('partnerships'));
    }

    public function create()
    {
        $categories = partner_category::all();
        return view('partnerships.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'part_title' => 'required',
            'part_desc' => 'required',
            // Add other validation rules as needed
        ]);
        $authenticatedUserId = Auth::id();
        $request->merge(['user_id' => $authenticatedUserId]);
        // dd($request->all());
        $partnership = Partnership::create($request->all());

        return redirect()->route('partnerships.index')
            ->with('success', 'تم إنشاء الشراكة بنجاح');
    }

    public function show(Partnership $partnership)
    {
        return view('partnerships.show', compact('partnership'));
    }

    public function edit(Partnership $partnership)
    {
        $categories = partner_category::all();
        return view('partnerships.edit', compact('partnership', 'categories'));
    }

    public function update(Request $request, Partnership $partnership)
    {
        $request->validate([
            'part_title' => 'required',
            'part_desc' => 'required',
            // Add other validation rules as needed
        ]);

        $partnership->update($request->all());

        return redirect()->route('partnerships.index')
            ->with('success', 'تم تحديث الشراكة بنجاح');
    }

    public function destroy(Partnership $partnership)
    {
        $partnership->delete();

        return redirect()->route('partnerships.index')
            ->with('success', 'تم حذف الشراكة بنجاح');
    }
}