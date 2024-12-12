<?php
// class AppointmentController extends Controller
// {
//     // Appointment management
//     public function createAppointment() {}
//     public function updateAppointment() {}
//     public function cancelAppointment() {}
//     public function deleteAppointment() {}
//     public function updateAppointmentStatus() {}

//     // View appointments
//     public function viewAppointment() {}
//     public function viewAppointmentDetails() {}
//     public function listAppointments() {}
//     public function listAppointmentsByDoctor() {}
//     public function listAppointmentsByPatient() {}

//     // Notifications
//     public function sendAppointmentReminders() {}

//     // Video management (if applicable)
//     public function manageVideoLinks() {}
// }

namespace App\Http\Controllers;

use App\Models\{Appointment, Patient, Doctor};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display all appointments
     */
    public function index()
    {
        $appointments = Appointment::all();
        return response()->json(['appointments' => $appointments], 200);
    }

    /**
     * Cancel an appointment
     */
    public function cancelAppointment(Request $request, $appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        if ($appointment->patient_id != Auth::guard('patient')->id()) {
            return response()->json(['message' => 'You are not authorized to cancel this appointment'], 403);
        }

        $appointment->status = 'Cancelled';
        $appointment->save();

        return response()->json(['message' => 'Appointment cancelled successfully'], 200);
    }

    /**
     * View appointment details
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
     * List appointments by doctor
     */
    public function listAppointmentsByDoctor($doctorId)
    {
        $doctor = Doctor::find($doctorId);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $appointments = Appointment::where('doctor_id', $doctorId)->get();
        return response()->json(['appointments' => $appointments], 200);
    }

    /**
     * List appointments by patient
     */
    public function listAppointmentsByPatient($patientId)
    {
        $patient = Patient::find($patientId);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $appointments = Appointment::where('patient_id', $patientId)->get();
        return response()->json(['appointments' => $appointments], 200);
    }

    /**
     * Create a new appointment
     */
    public function createAppointment(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date|after:now',
            'reason' => 'required|string|max:255',
        ]);

        $appointment = Appointment::create([
            'doctor_id' => $validated['doctor_id'],
            'patient_id' => $validated['patient_id'],
            'appointment_date' => $validated['appointment_date'],
            'reason' => $validated['reason'],
            'status' => 'Scheduled',
        ]);

        return response()->json(['message' => 'Appointment created successfully', 'appointment' => $appointment], 201);
    }

    /**
     * Update an existing appointment
     */
    public function updateAppointment(Request $request, $appointmentId)
    {
        $validated = $request->validate([
            'appointment_date' => 'nullable|date|after:now',
            'reason' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:Scheduled,Cancelled,Completed',
        ]);

        $appointment = Appointment::find($appointmentId);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->update(array_filter($validated));

        return response()->json(['message' => 'Appointment updated successfully', 'appointment' => $appointment], 200);
    }

    /**
     * Delete an appointment
     */
    public function deleteAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully'], 200);
    }

    /**
     * View a specific appointment
     */
    public function viewAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        return response()->json(['appointment' => $appointment], 200);
    }

    /**
     * List all appointments
     */
    public function listAppointments()
    {
        $appointments = Appointment::all();
        return response()->json(['appointments' => $appointments], 200);
    }

    /**
     * Send appointment reminders
     */
    public function sendAppointmentReminders()
    {
        $appointments = Appointment::where('appointment_date', '<=', now()->addDay())->get();

        foreach ($appointments as $appointment) {
            // Logic to send reminder (email/SMS) to patient and doctor
            // Assuming reminder is sent successfully
            $this->sendReminder($appointment);
        }

        return response()->json(['message' => 'Appointment reminders sent successfully'], 200);
    }

    /**
     * Manage video links for virtual appointments
     */
    public function manageVideoLinks(Request $request, $appointmentId)
    {
        $validated = $request->validate([
            'video_link' => 'required|url',
        ]);

        $appointment = Appointment::find($appointmentId);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->video_link = $validated['video_link'];
        $appointment->save();

        return response()->json(['message' => 'Video link updated successfully', 'appointment' => $appointment], 200);
    }

    /**
     * Update appointment status
     */
    public function updateAppointmentStatus(Request $request, $appointmentId)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Scheduled,Completed,Cancelled',
        ]);

        $appointment = Appointment::find($appointmentId);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->status = $validated['status'];
        $appointment->save();

        return response()->json(['message' => 'Appointment status updated successfully', 'appointment' => $appointment], 200);
    }

    /**
     * Helper function to send reminders
     */
    private function sendReminder(Appointment $appointment)
    {
        // Logic to send email or SMS reminder
        // For example, sending a reminder to the patient and doctor

        // Example: Send an email to patient and doctor
        $patient = Patient::find($appointment->patient_id);
        $doctor = Doctor::find($appointment->doctor_id);

        // Logic for sending emails or notifications
        // Mail::to($patient->email)->send(new AppointmentReminderMail($appointment));
        // Mail::to($doctor->email)->send(new AppointmentReminderMail($appointment));
    }
}
