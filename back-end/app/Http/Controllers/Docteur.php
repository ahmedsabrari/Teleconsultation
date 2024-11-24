<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Docteur extends Controller
{
    //
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('doctor')->attempt($credentials)) {
        return response()->json(['message' => 'Login successful'], 200);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}

public function logout()
{
    Auth::guard('doctor')->logout();
    return response()->json(['message' => 'Logout successful'], 200);
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:doctors',
        'password' => 'required|string|min:8',
        'specialty' => 'required|string',
    ]);

    $doctor = Doctor::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'specialty' => $request->specialty,
    ]);

    return response()->json(['message' => 'Registration successful', 'doctor' => $doctor], 201);
}


public function updateAccount(Request $request)
{
    $doctor = Auth::guard('doctor')->user();

    $request->validate([
        'name' => 'string|max:255',
        'email' => 'email|unique:doctors,email,' . $doctor->id,
        'specialty' => 'string',
    ]);

    $doctor->update($request->all());

    return response()->json(['message' => 'Account updated successfully', 'doctor' => $doctor], 200);
}



}
