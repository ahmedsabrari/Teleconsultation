<?php
// class PatientController extends Controller
// {
//     // Basic authentication and profile management
//     public function register() {}
//     public function login() {}
//     public function logout() {}
//     public function forgotPassword() {}
//     public function resetPassword() {}
//     public function verifyEmail() {}
//     public function changePassword() {}
//     public function viewProfile() {}
//     public function updateProfile() {}

//     // Appointment management
//     public function bookAppointment() {}
//     public function cancelAppointment() {}
//     public function viewAppointmentDetails() {}
//     public function viewAppointments() {}
//     public function viewAppointmentHistory() {}

//     // Medical records and prescriptions
//     public function viewPrescriptions() {}
//     public function viewMedicalHistory() {}
//     public function viewMedicalRecords() {}
//     public function requestPrescriptionRefill() {}

//     // Notifications
//     public function receiveNotifications() {}
//     public function notifications() {}
// }

namespace App\Http\Controllers;

use App\Models\{Patient, Appointment, Doctor, Prescription, Notification, MedicalRecord};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PatientController extends Controller
{
    /**
     * List all patients (Admin only)
     */
    public function index()
    {
        $patients = Patient::all();
        return response()->json(['patients' => $patients], 200);
    }

    /**
     * Register a new patient
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:patients',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15',
        ]);

        $patient = Patient::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
        ]);

        return response()->json(['message' => 'Registration successful', 'patient' => $patient], 201);
    }

    /**
     * Login a patient
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('patient')->attempt($credentials)) {
            $token = Auth::guard('patient')->user()->createToken('authToken')->plainTextToken;
            return response()->json(['message' => 'Login successful', 'token' => $token], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    /**
     * Logout the current patient
     */
    public function logout()
    {
        Auth::guard('patient')->user()->tokens()->delete();
        return response()->json(['message' => 'Logout successful'], 200);
    }

    /**
     * Forgot Password
     */
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Reset link sent to your email'], 200)
            : response()->json(['message' => 'Unable to send reset link'], 500);
    }

    /**
     * Reset Password
     */
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset($validated, function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();
        });

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successfully'], 200)
            : response()->json(['message' => 'Failed to reset password'], 500);
    }

    /**
     * View profile of the authenticated patient
     */
    public function viewProfile()
    {
        return response()->json(['profile' => Auth::guard('patient')->user()], 200);
    }

    /**
     * Update the patient's profile
     */
    public function updateProfile(Request $request)
    {
        $patient = Auth::guard('patient')->user();

        $validated = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $filePath;
        }

        $patient->update($validated);

        return response()->json(['message' => 'Profile updated successfully', 'patient' => $patient], 200);
    }

    /**
     * Book an appointment
     */
    public function bookAppointment(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:now',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $validated['doctor_id'],
            'appointment_date' => $validated['appointment_date'],
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Appointment booked successfully', 'appointment' => $appointment], 201);
    }

    /**
     * Cancel an appointment
     */
    public function cancelAppointment(Appointment $appointment)
    {
        if ($appointment->patient_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        $appointment->update(['status' => 'canceled']);

        return response()->json(['message' => 'Appointment canceled successfully'], 200);
    }

    /**
     * View appointment details
     */
    public function viewAppointmentDetails(Appointment $appointment)
    {
        if ($appointment->patient_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        return response()->json(['appointment' => $appointment->load('doctor')], 200);
    }

    /**
     * View medical records of the authenticated patient
     */
    public function viewMedicalRecords()
    {
        $medicalRecords = Auth::guard('patient')->user()->medicalRecords;
        return response()->json(['medicalRecords' => $medicalRecords], 200);
    }

    /**
     * View the list of prescriptions
     */
    public function viewPrescriptions()
    {
        $prescriptions = Auth::guard('patient')->user()->prescriptions()->with('medications')->get();
        return response()->json(['prescriptions' => $prescriptions], 200);
    }

    /**
     * Receive notifications for the patient
     */
    public function receiveNotifications()
    {
        $notifications = Auth::guard('patient')->user()->notifications()->unread()->get();
        return response()->json(['notifications' => $notifications], 200);
    }
}
