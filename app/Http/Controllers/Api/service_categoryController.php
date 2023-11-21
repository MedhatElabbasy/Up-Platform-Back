<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\service_category;

class service_categoryController extends Controller
{
    public function index(){
        $service_category=service_category::all();
        return response()->json($service_category);
    }

    public function store(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'scategory_name'=>'required|string',
            'scategory_description'=>'required|string'
        ]    
    );
    $service_category=service_category::create( [

        'scategory_name'=> $request->scategory_name,
        'scategory_description'=> $request->scategory_description
    ]);
    return response()->json(['msg'=>'category added successfully',"status"=>200]);
}
public function show($id){
    $service_category=service_category::find($id);
    return response()->json($service_category);
}
          
public function update(Request $request, $id){
    $this->validate($request, [

        'scategory_name'=>'required|string',
        'scategory_description'=>'required|string'
    ]);



    $service_category=service_category::find($id);
    if(!$service_category){
        return response()->json(['message'=> 'category not found', "status"=>404]);
     }
    $service_category->scategory_name=$request->scategory_name;
    $service_category->scategory_description=$request->scategory_description;
    $service_category->save();
    return response()->json(['msg'=> 'category updated successfully',"status"=>200]);
}

                    

public function delete($id){
    $service_category=service_category::find($id);
    if(!$service_category){
        return response()->json(['message'=> 'category not found',"status"=>404]);
     }

     $service_category->delete();
     return response()->json(['msg'=> 'category deleted successfully',"status"=>200]);
}
                    
                

}


