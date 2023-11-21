<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\freelance_services;

class freelance_servicesController extends Controller
{

    public function index(){
        $freelance_services=freelance_services::all();
        return response()->json($freelance_services);
    }

    public function store(Request $request){
        // dd($request->all());
                $this->validate($request, [
                    'free_service_name'=>'required|string',
                    'free_service_desc'=>'required|string',
                    'free_jobtitle'=> 'required|string',
                    'service_category'=>'required|string',
                    'free_service_skills'=>'required|string',
                    'service_location'=> 'required|string',
                    'service_image'=>'nullable|image|mimes:jpg,png,jpeg',
                    'service_cost_from'=>'required',
                    'service_cost_to'=> 'required',
                    'user_id'=> 'required',

                ] );

                $img = $request->file('service_image');
                $extenstion = $img->getClientOriginalExtension();
                $ImageName = "freelance". uniqid() . ".$extenstion" ;
       
                //Move Img to it is folder
                $img->move( public_path('Uploads/freelance') , $ImageName);

                $freelance_services=freelance_services::create( [

                    'free_service_name'=> $request->free_service_name,
                    'free_service_desc'=> $request->free_service_desc,
                    'free_jobtitle'=>$request->free_jobtitle,
                    'service_category'=>$request->service_category,
                    'free_service_skills'=> $request->free_service_skills,
                    'service_location'=> $request->service_location,
                    'service_image'=>$ImageName,
                    'service_cost_from'=> $request->service_cost_from,
                    'service_cost_to'=> $request->service_cost_to,
                    'user_id'=> $request->user_id,
        
                ]);

                return response()->json(['msg'=>'freelance services added successfully',"status"=>200]);

                }

                public function show($id){
                    $freelance_services=freelance_services::find($id);
                    return response()->json($freelance_services);
                }






                public function update(Request $request, $id){
                    $this->validate($request, [
                        'free_service_name'=>'required|string',
                        'free_service_desc'=>'required|string',
                        'free_jobtitle'=> 'required|string',
                        'service_category'=>'required|string',
                        'free_service_skills'=>'required|string',
                        'service_location'=> 'required|string',
                        'service_image'=>'nullable|image|mimes:jpg,png,jpeg',
                        'service_cost_from'=>'required',
                        'service_cost_to'=> 'required',
                        'user_id'=> 'required',
                    ]);

                    $freelance_services=freelance_services::find($id);
                    if(!$freelance_services){
                        return response()->json(['message'=> 'freelance services not found',"status"=>404]);

                    }

                    $ImageName = $freelance_services->service_image ;

                    if( $request->hasFile('service_image') )
                    {
                        if($ImageName !== null )
                        {
                            $file_delete=public_path('Uploads/freelance/') . $ImageName;
                            if (file_exists($file_delete)) {unlink($file_delete);}
                        }
           
                   // get image details
             $img = $request->file('service_image');
             $extenstion = $img->getClientOriginalExtension();
             $ImageName = "freelance". uniqid() . ".$extenstion" ;

             //Move Img to it is folder
             $img->move( public_path('Uploads/freelance') , $ImageName);

                    }
                
                
                    $freelance_services->free_service_name=$request->free_service_name;
                    $freelance_services->free_service_desc=$request->free_service_desc;
                    $freelance_services->free_jobtitle=$request->free_jobtitle;
                    $freelance_services->service_category=$request->service_category;
                    $freelance_services->free_service_skills=$request->free_service_skills;
                    $freelance_services->service_location=$request->service_location;
               
                    $freelance_services->service_image=$request->service_image;
                    $freelance_services->service_cost_from=$request->service_cost_from;
                    $freelance_services->service_cost_to=$request->service_cost_to;
                    $freelance_services->user_id=$request->user_id;

                    $freelance_services->save();
                    return response()->json(['msg'=> 'freelance services updated successfully',"status"=>200]);
                
        
                
                }

                public function delete($id){
                    $freelance_services=freelance_services::find($id);
                    if(!$freelance_services){
                        return response()->json(['message'=> 'freelance services not found',"status"=>404]);
                     }
                     if( $freelance_services->service_image !== null )
                     {
                         unlink( public_path('Uploads/freelance/') . $freelance_services->service_image );
                     }
                     $freelance_services->delete();
                     return response()->json(['msg'=> 'freelance services deleted successfully',"status"=>200]);
                }






}



