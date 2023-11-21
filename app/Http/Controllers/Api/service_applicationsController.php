<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\service_applications;

class service_applicationsController extends Controller
{
    public function index()
    {
        $service_applications = service_applications::all();
        return response()->json($service_applications);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'user_id' => 'required',
            'service_id' => 'required',

        ]);


        $service_applications = service_applications::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,

        ]);


        return response()->json(['msg' => 'service application added successfully', "status" => 200]);
    }



    public function show($id)
    {
        $service_applications = service_applications::find($id);
        return response()->json($service_applications);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'service_id' => 'required',

        ]);
        $service_applications = service_applications::find($id);
        if (!$service_applications) {
            return response()->json(['message' => 'service application not found', "status" => 404]);
        }
        $service_applications->user_id = $request->user_id;
        $service_applications->service_id = $request->service_id;

        $service_applications->save();
        return response()->json(['msg' => 'service application updated successfully', "status" => 200]);
    }


    public function delete($id)
    {
        $service_applications = service_applications::find($id);
        if (!$service_applications) {
            return response()->json(['message' => 'service application not found', "status" => 404]);
        }
        $service_applications->delete();
        return response()->json(['msg' => 'service application  deleted successfully', "status" => 200]);
    }
}
