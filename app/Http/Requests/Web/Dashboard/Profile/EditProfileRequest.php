<?php

namespace App\Http\Requests\Web\Dashboard\Profile;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2',
            'old_password' => 'sometimes|min:6',
            'new_password' => 'required_with:old_password|min:6|confirmed',
        ];
    }
}
