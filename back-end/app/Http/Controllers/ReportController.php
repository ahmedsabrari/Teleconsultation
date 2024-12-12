<?php
// class ReportController extends Controller
// {
//     // Report generation
//     public function generatePatientReport() {}
//     public function generateDoctorReport() {}
//     public function generateFinancialReport() {}

//     // Report details
//     public function viewReportDetails() {}
// }


namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display all reports (Admin view)
     */
    public function index()
    {
        // You can retrieve all reports or generate a list of available reports
        return response()->json(['message' => 'Available reports: Patient, Doctor, Financial'], 200);
    }

    /**
     * Generate a report for a specific patient
     */
    public function generatePatientReport(Request $request, $patientId)
    {
        $patient = Patient::find($patientId);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        // Generate the patient report (for example, include medical history, appointments, and prescriptions)
        $appointments = Appointment::where('patient_id', $patientId)->get();
        $medicalRecords = $patient->medicalRecords; // Assuming a relationship is defined
        $prescriptions = $patient->prescriptions;

        $report = [
            'patient_name' => $patient->name,
            'appointments' => $appointments,
            'medical_records' => $medicalRecords,
            'prescriptions' => $prescriptions
        ];

        return response()->json(['message' => 'Patient report generated successfully', 'report' => $report], 200);
    }

    /**
     * Generate a report for a specific doctor
     */
    public function generateDoctorReport(Request $request, $doctorId)
    {
        $doctor = Doctor::find($doctorId);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        // Generate the doctor report (e.g., include list of appointments, prescriptions, and patients seen)
        $appointments = Appointment::where('doctor_id', $doctorId)->get();
        $patients = $doctor->patients; // Assuming a relationship is defined
        $prescriptions = $doctor->prescriptions;

        $report = [
            'doctor_name' => $doctor->name,
            'appointments' => $appointments,
            'patients' => $patients,
            'prescriptions' => $prescriptions
        ];

        return response()->json(['message' => 'Doctor report generated successfully', 'report' => $report], 200);
    }

    /**
     * Generate a financial report (total income, payments received)
     */
    public function generateFinancialReport(Request $request)
    {
        // Retrieve total payments for a specific period (e.g., monthly, yearly)
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());

        $payments = Payment::whereBetween('paid_at', [$startDate, $endDate])->get();

        $totalAmount = $payments->sum('amount');
        $report = [
            'total_payments' => $payments->count(),
            'total_income' => $totalAmount,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        return response()->json(['message' => 'Financial report generated successfully', 'report' => $report], 200);
    }

    /**
     * View detailed information of a specific report (Patient, Doctor, Financial)
     */
    public function viewReportDetails($reportId)
    {
        // Depending on the report type, you would retrieve it from the database
        $report = null; // Replace with actual report fetching logic

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        return response()->json(['report' => $report], 200);
    }
}
