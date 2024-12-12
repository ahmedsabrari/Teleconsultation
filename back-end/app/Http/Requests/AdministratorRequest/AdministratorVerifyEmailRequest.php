<?php

namespace App\Http\Requests\AdministratorRequest;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorVerifyEmailRequest extends FormRequest
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
            'id' => 'required|exists:administrators,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The administrator ID is required.',
            'id.exists' => 'The administrator ID does not exist.',
        ];
    }
}
