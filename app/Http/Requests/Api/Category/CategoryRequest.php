<?php

namespace App\Http\Requests\Api\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:categories|max:255',
            'description' => 'unique:categories|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ' الاسم مطلوب',
            'name.unique' => 'لقد تم أخذ الاسم بالفعل',
            'name.max' => 'لا يجوز أن يكون الاسم أكبر من:  255',
            'description.unique' => 'لقد تم بالفعل أخذ  هذا الوصف',
            'description.max' => 'لا يجوز أن يكون الوصف أكبر من:255',
        ];
    }
}
