<?php

namespace App\Http\Services\Auth;

use App\Http\Services\Service;
use App\Mail\Auth\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Repositories\Auth\AuthRepository;

class ResetPasswordService extends Service
{
    public function __construct(
        private AuthRepository $authRepository
    ) {}

    public function forgot()
    {
        if ($this->authRepository->emailExists(request()->email)) {
            $verificationCode = rand(1000, 9999);

            $this->authRepository->passwordResetVerification(
                request()->email,
                $verificationCode
            );

            try {
                Mail::to(request()->email)->send(new ResetPasswordMail($verificationCode));
            } catch (\Exception $e) {
                dd($e->getMessage());
                return $this->error(400, "عذرا حاول في وقت لاحق!");
            }
        } else {
            return $this->error(400, "هذا البريد الإلكتروني غير موجود");
        }
    }

    public function forgotVerify()
    {
        $reset = $this->authRepository->passwordResetVerify(
            request()->email,
            request()->code
        );

        if (!$reset) return $this->error(400, "الرمز ليس صالح");
    }

    public function reset()
    {
        $reset = $this->authRepository->passwordReset(
            request()->email,
            request()->code,
            request()->password
        );

        if (!$reset) return $this->error(400, "الرمز ليس صالح");
    }
}
