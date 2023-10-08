<?php

namespace App\Http\Controllers\Web\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Auth\ForgotPasswordRequest;
use App\Http\Services\Auth\ResetPasswordService;

class ForgotPasswordController extends Controller
{
    public function __construct(
        private ResetPasswordService $resetPasswordService,
    ) {}

    public function index(){
        return view('dashboard.forgot-password');
    }

    public function store(ForgotPasswordRequest $request){
        $this->resetPasswordService->forgot($request->email);

        return redirect()->route('dashboard.forgot-password.show', ['forgot_password'=>'reset']);
    }

    public function show(){
        return view('dashboard.reset-password');
    }

    public function update(){
        return view('dashboard.reset-password');
    }
}
