<?php

namespace App\Http\Services\Auth;

use App\Http\Services\Service;
use App\Http\Resources\UserResource;
use App\Http\Repositories\Auth\AuthRepository;
use App\Http\Services\Auth\EmailVerificationService;

class RegisterService extends Service
{
    public function __construct(
        private AuthRepository $authRepository,
        private EmailVerificationService $emailVerificationService
    ) {}

    public function register(array $data)
    {
        $user = $this->authRepository->createUser($data);

        $this->emailVerificationService->send('email', $user);

        return [
            "token" => $user->createToken('auth_token')->plainTextToken,
            "user" => new UserResource($user)
        ];
    }
}
