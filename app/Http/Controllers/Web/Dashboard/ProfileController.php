<?php

namespace App\Http\Controllers\Web\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Profile\EditProfileRequest;

class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile');
    }

    public function store(EditProfileRequest $request){
        auth()->user()->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('message', 'تم التحديث بنجاح');
    } 
}
