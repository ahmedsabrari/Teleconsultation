<?php
// class DoctorController extends Controller
// {
//     // Authentication and profile management
//     public function login() {}
//     public function logout() {}
//     public function forgotPassword() {}
//     public function resetPassword() {}
//     public function verifyEmail() {}
//     public function changePassword() {}
//     public function viewProfile() {}
//     public function updateProfile() {}

//     // Appointment management
//     public function listAppointments() {}
//     public function viewAppointmentDetails() {}
//     public function acceptAppointment() {}
//     public function declineAppointment() {}
//     public function updateAppointmentStatus() {}

//     // Medical history and records
//     public function viewMedicalHistory() {}
//     public function viewPatientHistory() {}
//     public function manageMedicalRecords() {}
//     public function generateReportsForPatient() {}
//     public function prescribeMedication() {}

//     // Schedule management
//     public function manageSchedules() {}
//     public function updateAvailability() {}

//     // Reporting
//     public function generateMedicalReports() {}
//     public function createMedicalReport() {}
// }


namespace App\Http\Controllers;

use App\Models\{Doctor, Patient, Appointment, MedicalHistory, MedicalReport, Prescription, MedicalRecord};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class DoctorController extends Controller
{
    /**
     * Display the doctor's profile
     */
    public function index()
    {
        $doctor = Auth::guard('doctor')->user();
        return response()->json(['doctor' => $doctor], 200);
    }

    /**
     * Login a doctor
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('doctor')->attempt($credentials)) {
            $token = Auth::guard('doctor')->user()->createToken('DoctorToken')->plainTextToken;
            return response()->json(['message' => 'Login successful', 'token' => $token], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    /**
     * Logout a doctor
     */
    public function logout()
    {
        Auth::guard('doctor')->user()->tokens()->delete();
        return response()->json(['message' => 'Logout successful'], 200);
    }

    /**
     * Register a new doctor
     */
    public function registerDoctor(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors',
            'password' => 'required|string|min:8',
            'specialization' => 'required|string|max:255',
        ]);

        $doctor = Doctor::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'specialization' => $validated['specialization'],
        ]);

        return response()->json(['message' => 'Doctor registered successfully', 'doctor' => $doctor], 201);
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
     * Verify the doctor's email
     */
    public function verifyEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:doctors,email']);
        
        // Assume email verification logic here
        
        return response()->json(['message' => 'Email verification link sent'], 200);
    }

    /**
     * Change the doctor's password
     */
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $doctor = Auth::guard('doctor')->user();

        if (Hash::check($validated['current_password'], $doctor->password)) {
            $doctor->password = Hash::make($validated['new_password']);
            $doctor->save();

            return response()->json(['message' => 'Password changed successfully'], 200);
        }

        return response()->json(['message' => 'Current password is incorrect'], 400);
    }

    /**
     * View the doctor's profile
     */
    public function viewProfile()
    {
        $doctor = Auth::guard('doctor')->user();
        return response()->json(['doctor' => $doctor], 200);
    }

    /**
     * List all appointments for the doctor
     */
    public function listAppointments()
    {
        $doctor = Auth::guard('doctor')->user();
        $appointments = Appointment::where('doctor_id', $doctor->id)->get();
        return response()->json(['appointments' => $appointments], 200);
    }

    /**
     * View details of a specific appointment
     */
    public function viewAppointmentDetails($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }
        return response()->json(['appointment' => $appointment], 200);
    }

    /**
     * Accept an appointment
     */
    public function acceptAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if (!$appointment || $appointment->doctor_id !== Auth::guard('doctor')->id()) {
            return response()->json(['message' => 'Appointment not found or not assigned to this doctor'], 404);
        }

        $appointment->status = 'Accepted';
        $appointment->save();

        return response()->json(['message' => 'Appointment accepted'], 200);
    }

    /**
     * Decline an appointment
     */
    public function declineAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if (!$appointment || $appointment->doctor_id !== Auth::guard('doctor')->id()) {
            return response()->json(['message' => 'Appointment not found or not assigned to this doctor'], 404);
        }

        $appointment->status = 'Declined';
        $appointment->save();

        return response()->json(['message' => 'Appointment declined'], 200);
    }

    /**
     * View a patient's medical history
     */
    public function viewMedicalHistory($patientId)
    {
        $medicalHistory = MedicalHistory::where('patient_id', $patientId)->get();
        if ($medicalHistory->isEmpty()) {
            return response()->json(['message' => 'No medical history found for this patient'], 404);
        }

        return response()->json(['medical_history' => $medicalHistory], 200);
    }

    /**
     * Generate a report for a patient
     */
    public function generateReportsForPatient(Request $request, $patientId)
    {
        $validated = $request->validate([
            'report_type' => 'required|string|in:general,financial',
        ]);

        // Assume report generation logic here
        $report = Report::create([
            'patient_id' => $patientId,
            'report_type' => $validated['report_type'],
            'generated_by' => Auth::guard('doctor')->id(),
        ]);

        return response()->json(['message' => 'Report generated successfully', 'report' => $report], 200);
    }

    /**
     * Update doctor's availability
     */
    public function updateAvailability(Request $request)
    {
        $validated = $request->validate([
            'availability' => 'required|boolean',
        ]);

        $doctor = Auth::guard('doctor')->user();
        $doctor->available = $validated['availability'];
        $doctor->save();

        return response()->json(['message' => 'Availability updated'], 200);
    }

    /**
     * View all appointments for the doctor
     */
    public function viewAppointments()
    {
        $appointments = Appointment::where('doctor_id', Auth::guard('doctor')->id())->get();
        return response()->json(['appointments' => $appointments], 200);
    }

    /**
     * Consult a patient
     */
    public function consultPatient(Request $request, $patientId)
    {
        $validated = $request->validate([
            'consultation_notes' => 'required|string|max:1000',
        ]);

        $consultation = Consultation::create([
            'doctor_id' => Auth::guard('doctor')->id(),
            'patient_id' => $patientId,
            'notes' => $validated['consultation_notes'],
        ]);

        return response()->json(['message' => 'Consultation recorded successfully', 'consultation' => $consultation], 201);
    }

    /**
     * Manage medical records
     */
    public function manageMedicalRecords(Request $request)
    {
        // Assume CRUD for medical records
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'record_data' => 'required|string',
        ]);

        $medicalRecord = MedicalRecord::create([
            'patient_id' => $validated['patient_id'],
            'record_data' => $validated['record_data'],
        ]);

        return response()->json(['message' => 'Medical record added successfully', 'record' => $medicalRecord], 201);
    }

    /**
     * Prescribe medication
     */
    public function prescribeMedication(Request $request, $patientId)
    {
        $validated = $request->validate([
            'medication' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
        ]);

        $prescription = Prescription::create([
            'patient_id' => $patientId,
            'doctor_id' => Auth::guard('doctor')->id(),
            'medication' => $validated['medication'],
            'dosage' => $validated['dosage'],
        ]);

        return response()->json(['message' => 'Prescription added successfully', 'prescription' => $prescription], 201);
    }

    /**
     * View a patient's history
     */
    public function viewPatientHistory($patientId)
    {
        $patient = Patient::find($patientId);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        return response()->json(['patient_history' => $patient], 200);
    }

    /**
     * Generate a medical report
     */
    public function generateMedicalReports(Request $request, $patientId)
    {
        $validated = $request->validate([
            'report_details' => 'required|string|max:1000',
        ]);

        $report = MedicalReport::create([
            'patient_id' => $patientId,
            'doctor_id' => Auth::guard('doctor')->id(),
            'report_details' => $validated['report_details'],
        ]);

        return response()->json(['message' => 'Medical report generated successfully', 'report' => $report], 200);
    }

    /**
     * Update doctor's profile
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . Auth::guard('doctor')->id(),
            'specialization' => 'required|string|max:255',
        ]);

        $doctor = Auth::guard('doctor')->user();
        $doctor->update($validated);

        return response()->json(['message' => 'Profile updated successfully', 'doctor' => $doctor], 200);
    }

    /**
     * Update appointment status
     */
    public function updateAppointmentStatus(Request $request, $appointmentId)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:completed,cancelled',
        ]);

        $appointment = Appointment::find($appointmentId);
        if (!$appointment || $appointment->doctor_id !== Auth::guard('doctor')->id()) {
            return response()->json(['message' => 'Appointment not found or not assigned to this doctor'], 404);
        }

        $appointment->status = $validated['status'];
        $appointment->save();

        return response()->json(['message' => 'Appointment status updated successfully'], 200);
    }

    /**
     * View medical records
     */
    public function viewMedicalRecords($patientId)
    {
        $medicalRecords = MedicalRecord::where('patient_id', $patientId)->get();
        return response()->json(['medical_records' => $medicalRecords], 200);
    }

    /**
     * Create a medical report
     */
    public function createMedicalReport(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'report_details' => 'required|string|max:1000',
        ]);

        $report = MedicalReport::create([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => Auth::guard('doctor')->id(),
            'report_details' => $validated['report_details'],
        ]);

        return response()->json(['message' => 'Medical report created successfully', 'report' => $report], 201);
    }

    /**
     * Manage doctor's schedule
     */
    public function manageSchedules(Request $request)
    {
        $validated = $request->validate([
            'schedule' => 'required|array',
            'schedule.*.day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'schedule.*.start_time' => 'required|date_format:H:i',
            'schedule.*.end_time' => 'required|date_format:H:i|after:schedule.*.start_time',
        ]);

        // Assume schedule update logic here

        return response()->json(['message' => 'Schedule updated successfully'], 200);
    }
}