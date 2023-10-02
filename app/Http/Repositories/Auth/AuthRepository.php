<?php

namespace App\Http\Repositories\Auth;

use App\Models\User;
use App\Models\PasswordResetToken;
use App\Models\PersonalAccessCode;

class AuthRepository
{
    public function createUser($data)
    {
        return User::create($data);
    }

    public function getUserWithEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function createVerificationCode($user_id, $action, $code)
    {
        PersonalAccessCode::where("user_id", $user_id)->where('action', $action)->delete();

        return PersonalAccessCode::create([
            'user_id' => $user_id,
            'code' => hash('sha512', $code),
            'action' => $action,
            'expires_at' => now()->addHours(1)
        ]);
    }

    public function emailVerification($user_id, $action, $code)
    {
        $verify = PersonalAccessCode::where("user_id", $user_id)
            ->where("action", $action)
            ->where("code", hash('sha512', $code))
            ->first();
        if (!$verify) return false;

        $verify->delete();

        return true;
    }

    public function emailVerified($user_id)
    {
        return User::find($user_id)->update([
            'email_verified_at' => now()
        ]);
    }

    public function emailNotVerified($user_id)
    {
        return User::find($user_id)->update([
            'email_verified_at' => null
        ]);
    }

    public function emailExists($email)
    {
        return User::where('email', $email)->exists();
    }

    public function phoneExists($phone)
    {
        return User::where('phone', $phone)->exists();
    }

    public function passwordResetVerification($email, $code)
    {
        PasswordResetToken::where("email", $email)->delete();

        PasswordResetToken::insert([
            'email' => $email,
            'token' => hash('sha512', $code),
            'created_at' => now()
        ]);
    }

    public function passwordReset($email, $code, $pass)
    {
        $password = PasswordResetToken::where("email", $email)
            ->where("token", hash('sha512', $code))
            ->first();
        if (!$password) return false;

        $password->delete();

        return User::where('email', $email)->first()->update([
            'password' => $pass
        ]);
    }

    public function passwordResetVerify($email, $code)
    {
        $password = PasswordResetToken::where("email", $email)
            ->where("token", hash('sha512', $code))
            ->first();
        if (!$password) return false;

        return true;
    }
}
