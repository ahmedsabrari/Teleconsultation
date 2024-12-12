<?php
// class PrescriptionController extends Controller
// {
//     // Prescription management
//     public function createPrescription() {}
//     public function updatePrescription() {}
//     public function deletePrescription() {}

//     // Viewing prescriptions
//     public function viewPrescription() {}
//     public function listPrescriptions() {}
//     public function viewPrescriptionDetails() {}

//     // Medication management
//     public function addMedication() {}
//     public function removeMedication() {}
// }


namespace App\Http\Controllers;

use App\Models\{Prescription, Medication, Appointment, Doctor};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    /**
     * Display all prescriptions
     */
    public function index()
    {
        $prescriptions = Prescription::all();
        return response()->json(['prescriptions' => $prescriptions], 200);
    }

    /**
     * Create a new prescription
     */
    public function createPrescription(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date_issued' => 'required|date',
            'doctor_notes' => 'nullable|string|max:255',
        ]);

        $appointment = Appointment::find($validated['appointment_id']);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $prescription = Prescription::create([
            'appointment_id' => $validated['appointment_id'],
            'doctor_id' => $validated['doctor_id'],
            'date_issued' => $validated['date_issued'],
            'doctor_notes' => $validated['doctor_notes'] ?? null,
        ]);

        return response()->json(['message' => 'Prescription created successfully', 'prescription' => $prescription], 201);
    }

    /**
     * Update an existing prescription
     */
    public function updatePrescription(Request $request, $prescriptionId)
    {
        $validated = $request->validate([
            'doctor_notes' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,expired',
        ]);

        $prescription = Prescription::find($prescriptionId);
        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }

        $prescription->update(array_filter($validated));

        return response()->json(['message' => 'Prescription updated successfully', 'prescription' => $prescription], 200);
    }

    /**
     * Delete a prescription
     */
    public function deletePrescription($prescriptionId)
    {
        $prescription = Prescription::find($prescriptionId);
        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }

        $prescription->delete();

        return response()->json(['message' => 'Prescription deleted successfully'], 200);
    }

    /**
     * View a specific prescription
     */
    public function viewPrescription($prescriptionId)
    {
        $prescription = Prescription::find($prescriptionId);
        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }

        return response()->json(['prescription' => $prescription], 200);
    }

    /**
     * List all prescriptions for a specific patient
     */
    public function listPrescriptions($patientId)
    {
        $prescriptions = Prescription::whereHas('appointment', function ($query) use ($patientId) {
            $query->where('patient_id', $patientId);
        })->get();

        return response()->json(['prescriptions' => $prescriptions], 200);
    }

    /**
     * Add medication to a prescription
     */
    public function addMedication(Request $request, $prescriptionId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $prescription = Prescription::find($prescriptionId);
        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }

        $medication = Medication::create([
            'prescription_id' => $prescriptionId,
            'name' => $validated['name'],
            'dosage' => $validated['dosage'],
            'duration' => $validated['duration'],
        ]);

        return response()->json(['message' => 'Medication added successfully', 'medication' => $medication], 201);
    }

    /**
     * Remove medication from a prescription
     */
    public function removeMedication($prescriptionId, $medicationId)
    {
        $prescription = Prescription::find($prescriptionId);
        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }

        $medication = Medication::find($medicationId);
        if (!$medication || $medication->prescription_id !== $prescriptionId) {
            return response()->json(['message' => 'Medication not found in this prescription'], 404);
        }

        $medication->delete();

        return response()->json(['message' => 'Medication removed successfully'], 200);
    }

    /**
     * View details of a prescription including medications
     */
    public function viewPrescriptionDetails($prescriptionId)
    {
        $prescription = Prescription::with('medications')->find($prescriptionId);
        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }

        return response()->json(['prescription' => $prescription], 200);
    }
}
