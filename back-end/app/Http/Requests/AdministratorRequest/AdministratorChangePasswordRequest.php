<?php

namespace App\Http\Requests\AdministratorRequest;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorChangePasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'The current password is required.',
            'new_password.required' => 'The new password is required.',
            'new_password.min' => 'The new password must be at least 8 characters long.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ];
    }
}
