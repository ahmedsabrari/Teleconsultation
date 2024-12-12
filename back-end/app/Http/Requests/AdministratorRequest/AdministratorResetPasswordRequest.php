<?php

namespace App\Http\Requests\AdministratorRequest;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'email' => 'required|email|exists:administrators,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'token.required' => 'The reset token is required.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.exists' => 'This email address is not registered.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
