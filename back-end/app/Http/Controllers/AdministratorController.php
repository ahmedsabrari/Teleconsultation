<?php
// class AdministratorController extends Controller
// {
//     // Authentication and basic admin management
//     public function registerAdmin() {}
//     public function login() {}
//     public function logout() {}
//     public function forgotPassword() {}
//     public function resetPassword() {}
//     public function verifyEmail() {}
//     public function changePassword() {}
//     // Appointment management
//     public function viewAllAppointments() {}
//     // Medical entity management
//     public function manageDoctors() {}
//     public function managePatients() {}
//     // Dashboard and reporting
//     public function dashboard() {}
//     public function generateReports() {}
// }

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorRequest\AdministratorChangePasswordRequest;
use App\Http\Requests\AdministratorRequest\AdministratorForgotPasswordRequest;
use App\Http\Requests\AdministratorRequest\AdministratorGenerateReportsRequest;
use App\Http\Requests\AdministratorRequest\AdministratorLoginRequest;
use App\Http\Requests\AdministratorRequest\AdministratorRegisterRequest;
use App\Http\Requests\AdministratorRequest\AdministratorResetPasswordRequest;
use App\Http\Requests\AdministratorRequest\AdministratorVerifyEmailRequest;
use App\Models\{Administrator, Patient, Doctor, Appointment, Report};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AdministratorController extends Controller
{
    /**
     * Register a new administrator.
     */
    public function registerAdmin(AdministratorRegisterRequest $request)
    {
        $administrator = Administrator::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'Administrator registered successfully.',
            'administrator' => $administrator
        ], 201);
    }

    /**
     * Authenticate an administrator and generate a token.
     */
    public function login(AdministratorLoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials.'], 401);
        }

        $token = $request->user()->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token
        ], 200);
    }

    /**
     * Logout the administrator by revoking their tokens.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout successful.'], 200);
    }

    /**
     * Send a password reset link to the administrator's email.
     */
    public function forgotPassword(AdministratorForgotPasswordRequest $request)
    {
        Password::sendResetLink($request->only('email'));
        return response()->json(['message' => 'Password reset link sent.'], 200);
    }

    /**
     * Reset the administrator's password using the token.
     */
    public function resetPassword(AdministratorResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($administrator, $password) {
                $administrator->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successful.'], 200)
            : response()->json(['message' => 'Password reset failed.'], 400);
    }

    /**
     * Verify the administrator's email address.
     */
    public function verifyEmail(AdministratorVerifyEmailRequest $request)
    {
        $administrator = Administrator::findOrFail($request->id);
        if ($administrator->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is already verified.'], 400);
        }

        $administrator->markEmailAsVerified();
        return response()->json(['message' => 'Email verified successfully.'], 200);
    }

    /**
     * Change the administrator's password.
     */
    public function changePassword(AdministratorChangePasswordRequest $request)
    {
        // Check if the current password is correct
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return response()->json(['message' => 'Current password is incorrect.'], 400);
        }

        // Update the administrator's password
        $request->user()->update(['password' => bcrypt($request->new_password)]);
        return response()->json(['message' => 'Password changed successfully.'], 200);
    }

    /**
     * Dashboard function to provide counts of appointments, doctors, and patients.
     */
    public function dashboard()
    {
        $totalAppointments = Appointment::count();
        $totalDoctors = Doctor::count();
        $totalPatients = Patient::count();
        $reportsCount = Report::count();
    
        return response()->json([
            'totalAppointments' => $totalAppointments,
            'totalDoctors' => $totalDoctors,
            'totalPatients' => $totalPatients,
            'reportsCount' => $reportsCount,
        ]);
    }

    /**
     * Retrieve all appointments with related patient and doctor data.
     */
    public function viewAllAppointments()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        return response()->json($appointments);
    }

    /**
     * Retrieve all doctors.
     */
    public function manageDoctors()
    {
        $doctors = Doctor::all();
        return response()->json($doctors);
    }

    /**
     * Retrieve all patients.
     */
    public function managePatients()
    {
        $patients = Patient::all();
        return response()->json($patients);
    }

    /**
     * Generate a report by the administrator.
     */
    public function generateReports(AdministratorGenerateReportsRequest $request)
    {
        // Create a new report with the provided title and content, and associate it with the logged-in administrator
        $report = Report::create([
            'title' => $request->title, // Title of the report
            'content' => $request->content, // Content of the report
            'created_by' => $request->user()->id, // ID of the administrator creating the report
        ]);

        // Return a success message along with the created report data
        return response()->json([
            'message' => 'Report generated successfully.',
            'report' => $report
        ], 201);
    }
}
