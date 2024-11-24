<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Patient extends Controller
{
    //

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('patient')->attempt($credentials)) {
        return response()->json(['message' => 'Login successful'], 200);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}

public function logout()
{
    Auth::guard('patient')->logout();
    return response()->json(['message' => 'Logout successful'], 200);
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:patients',
        'password' => 'required|string|min:8',
        'phone' => 'required|string',
    ]);

    $patient = Patient::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
    ]);

    return response()->json(['message' => 'Registration successful', 'patient' => $patient], 201);
}


public function updateAccount(Request $request)
{
    $patient = Auth::guard('patient')->user();

    $request->validate([
        'name' => 'string|max:255',
        'email' => 'email|unique:patients,email,' . $patient->id,
        'phone' => 'string',
    ]);

    $patient->update($request->all());

    return response()->json(['message' => 'Account updated successfully', 'patient' => $patient], 200);
}


}
