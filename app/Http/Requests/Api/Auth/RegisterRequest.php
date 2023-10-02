<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'     => 'required|string|max:64',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|digits_between:9,14|unique:users,phone',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
