<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use App\Http\Services\Auth\RegisterService;
use App\Http\Services\Auth\ResetPasswordService;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Services\Auth\EmailVerificationService;
use App\Http\Requests\Api\Auth\VerifyEmailRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;
use App\Http\Requests\Api\Auth\LoginWithProviderRequest;

class AuthController extends Controller
{
    public function __construct(
        private RegisterService $registerService,
        private LoginService $loginService,
        private ResetPasswordService $resetPasswordService,
        private EmailVerificationService $emailVerificationService
    ) {}

    public function register(RegisterRequest $request)
    {
        $data = $this->registerService->register([
            'name'     => request()->name,
            'email'    => request()->email,
            'phone'    => request()->phone,
            'password' => request()->password,
        ]);
        
        return $this->success([
            "data" => [
                "token" => $data['token'],
                "user" => $data['user']
            ]
        ]);
    }

    public function login(LoginRequest $request)
    {
        $data = $this->loginService->login(
            $request->email,
            $request->password
        );

        return $this->success([
            "data" => [
                "token" => $data['token'],
                "user" => $data['user']
            ],
            "message" => "تم تسجيل الدخول بنجاح"
        ]);
    }

    public function loginWithProvider(LoginWithProviderRequest $request)
    {
        $data = $this->loginService->loginWithProvider(
            $request->provider,
            $request->access_token,
        );
        
        return $this->success([
            "data" => [
                "token" => $data['token'],
                "user" => $data['user']
            ],
            "message" => "تم تسجيل الدخول بنجاح"
        ]);
    }

    public function logout()
    {
        $this->loginService->logout();

        return $this->success([
            'message' => "تم تسجيل الخروج بنجاح"
        ]);
    }

    public function verifyEmail(VerifyEmailRequest $request)
    {
        $data = $this->emailVerificationService->verify();

        return $this->success([
            'data'  => [
                'token' => $data['token'], 
                'user' => $data['user']
            ],
            'message' => "تم تفعيل البريد الإلكتروني"
        ]);
    }

    public function verifyEmailResend()
    {
        $this->emailVerificationService->send();

        return $this->success([
            'message' => "تم ارسال رمز التفعيل علي البريد الإلكتروني"
        ]);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $this->resetPasswordService->forgot();

        return $this->success([
            'message' => "تم ارسال رمز اعادة تعيين كلمة السر"
        ]);
    }

    public function forgotPasswordVerify(ForgotPasswordRequest $request)
    {
        $this->resetPasswordService->forgotVerify();

        return $this->success([
            'message' => "الرمز صالح"
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $this->resetPasswordService->reset();

        return $this->success([
            'message' => "تم إعادة تعيين كلمة السر بنجاح"
        ]);
    }
}
