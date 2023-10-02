<?php

namespace App\Http\Services\Auth;

use App\Http\Resources\UserResource;
use App\Http\Services\Service;
use Illuminate\Support\Facades\Mail;
use App\Mail\Auth\VerificationEmailMail;
use App\Http\Repositories\Auth\AuthRepository;

class EmailVerificationService extends Service
{
    public function __construct(
        private AuthRepository $authRepository
    ){}

    public function send($action = 'email', $user = null)
    {
        $user = ($user) ? $user : request()->user();

        if ($user->email_verified_at) return $this->error(401, "البريد الإلكتروني مفعلا");

        $verificationCode = rand(1000, 9999);

        $this->authRepository->createVerificationCode(
            $user->id,
            $action,
            $verificationCode
        );

        Mail::to($user->email)->send(new VerificationEmailMail($verificationCode));
    }

    public function verify()
    {
        $user = request()->user();

        if ($user->email_verified_at) return $this->error(401, "البريد الإلكتروني مفعلا");

        $verify = $this->authRepository->emailVerification($user->id, 'email', request()->code);
        if (!$verify) return $this->error(404, 'كود التفعيل خطأ او انتهت صلاحيته');

        $this->authRepository->emailVerified($user->id);
        $user->email_verified_at = now();

        return [
            'token' => $user->createToken('auth_token')->plainTextToken, 
            'user' => new UserResource($user)
        ];
    }
}
