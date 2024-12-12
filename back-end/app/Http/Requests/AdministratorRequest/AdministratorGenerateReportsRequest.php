<?php

namespace App\Http\Requests\AdministratorRequest;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorGenerateReportsRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }

    /**
     * Get the custom error messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'The report title is required and cannot be empty.',
            'title.string' => 'The report title must be a valid string.',
            'title.max' => 'The report title cannot exceed 255 characters.',
            'content.required' => 'The report content is required and cannot be empty.',
            'content.string' => 'The report content must be a valid string.',
        ];
    }
}
