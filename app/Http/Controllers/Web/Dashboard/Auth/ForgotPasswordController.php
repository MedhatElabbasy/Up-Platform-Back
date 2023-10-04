<?php

namespace App\Http\Controllers\Web\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Auth\LoginService;
use App\Http\Requests\Web\Dashboard\LoginRequest;

class ForgotPasswordController extends Controller
{
    public function __construct(
        private LoginService $loginService,
    ) {}

    public function index(){
        return view('dashboard.forgot-password');
    }

    public function store(){
    }

    public function update(){
    }
}
