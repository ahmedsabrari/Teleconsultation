<?php

namespace App\Http\Requests;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'We need to know your name!',
            'email.required' => 'An email address is required!',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Please choose a password!',
            'password.min' => 'Your password must be at least 8 characters.',
        ];
    }
}

// controller
// public function register(RegisterRequest $request)
// {
//// If validation passes, the code below is executed
//     $validated = $request->validated();

//     $user = User::create([
//         'name' => $validated['name'],
//         'email' => $validated['email'],
//         'password' => bcrypt($validated['password']),
//     ]);

//     return response()->json(['message' => 'User registered successfully!']);
// }

// route
// // If validation fails, errors will be passed automatically
// return redirect()->back()->withErrors($validator)->withInput();



