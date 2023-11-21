<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\partner_category;

class partner_categoryController extends Controller
{
    public function index(){
        $partner_category=partner_category::all();
        return response()->json($partner_category);
    }

    public function store(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'partcategory_name'=>'required|string',
            'partscategory_description'=>'required|string'
        ]    
    );
    $partner_category=partner_category::create( [

        'partcategory_name'=> $request->partcategory_name,
        'partscategory_description'=> $request->partscategory_description
    ]);
    return response()->json(['msg'=>'category added successfully',"status"=>200]);
}


public function show($id){
    $partner_category=partner_category::find($id);
    return response()->json($partner_category);
}

public function update(Request $request, $id){
    $this->validate($request, [

        'partcategory_name'=>'required|string',
        'partscategory_description'=>'required|string'
    ]);

    $partner_category=partner_category::find($id);
    if(!$partner_category){
        return response()->json(['message'=> 'category not found', "status"=>404]);
     }
    $partner_category->partcategory_name=$request->partcategory_name;
    $partner_category->partscategory_description=$request->partscategory_description;
    $partner_category->save();
    return response()->json(['msg'=> 'category updated successfully',"status"=>200]);
}
public function delete($id){
    $partner_category=partner_category::find($id);
    if(!$partner_category){
        return response()->json(['message'=> 'category not found',"status"=>404]);
     }
     $partner_category->delete();
     return response()->json(['msg'=> 'category deleted successfully',"status"=>200]);
}
}