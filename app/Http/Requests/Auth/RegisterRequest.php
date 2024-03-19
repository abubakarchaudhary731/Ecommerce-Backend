<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:50', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8', 'max:20'],
            'phone' => ['nullable', 'integer', 'max:11', 'unique:users,phone'],
            'image' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:100'],
        ];
    }
}
