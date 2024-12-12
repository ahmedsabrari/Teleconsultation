<?php

namespace App\Http\Requests\AdministratorRequest;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorRegisterRequest extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:administrators,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.max' => 'First name cannot exceed 50 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.max' => 'Last name cannot exceed 50 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'role.required' => 'The role is required.',
            'role.max' => 'The role cannot exceed 50 characters.',
        ];
    }
}
