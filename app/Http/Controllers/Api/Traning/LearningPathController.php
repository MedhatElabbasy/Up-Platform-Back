<?php

namespace App\Http\Controllers\Api\Traning;

use App\Http\Controllers\Controller;
use App\Models\LearningPath;
use Illuminate\Http\Request;

class LearningPathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apths = LearningPath::all();
        return response()->json($apths,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $apth = new LearningPath;
        // $apth->name =$request->name;
        // $apth->description =$request->description;
        // $apth->price =$request->price;

        // $apth->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}