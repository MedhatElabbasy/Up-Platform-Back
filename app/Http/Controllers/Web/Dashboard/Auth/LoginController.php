<?php

namespace App\Http\Controllers\Web\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Auth\LoginService;
use App\Http\Requests\Web\Dashboard\Auth\LoginRequest;

class LoginController extends Controller
{
    public function __construct(
        private LoginService $loginService,
    ) {}

    public function index(){
        return view('dashboard.login');
    }

    public function store(LoginRequest $request){
        $user = $this->loginService->login(
            $request->email,
            $request->password,
            ['Super Admin', 'Admin', 'Employee'],
            false
        );

        if(!$user) return redirect()->back();

        return redirect()->route('dashboard.home');
    }

    public function logout(){
        $this->loginService->logout();

        return redirect()->route('dashboard.login.index');
    }
}
