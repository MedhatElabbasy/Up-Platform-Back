<?php

namespace App\Http\Services\Auth;

use App\Http\Services\Service;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Repositories\Auth\AuthRepository;

class LoginService extends Service
{
    public function __construct(
        private AuthRepository $authRepository,
    ) {}

    public function login($email, $password)
    {
        if (!Auth::attempt(['email'=>$email, 'password'=>$password]))
            return $this->error(404, "البريد الإلكتروني او كلمة السر غير صحيحة");

        $user = request()->user();

        return [
            "token"  => $user->createToken('auth_token')->plainTextToken,
            "user"   => new UserResource($user)
        ];
    }

    public function loginWithProvider($provider, $access_token)
    {
        try {
            $providerUser = Socialite::driver($provider)->userFromToken($access_token);
            $email = $providerUser->getEmail();
            $name = $providerUser->getName();
    
            $user = $this->authRepository->getUserWithEmail($email);
            if(!$user){
                $user = $this->authRepository->createUser([
                    'name' => $name,
                    'email' => $email
                ]);
            }
        } catch (\Throwable $th) {
            return $this->error(404, "رمز الوصول غير صحيح");
        }


        return  [
            'token' => $user->createToken('auth_token_socialite')->plainTextToken,
            'user' => $user,
        ];
    }
    
    public function logout()
    {
        auth()->user()->tokens()->delete();
    }
}
