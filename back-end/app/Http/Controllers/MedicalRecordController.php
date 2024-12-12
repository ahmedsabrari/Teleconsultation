<?php
// class MedicalRecordController extends Controller
// {
//     // Medical record management
//     public function createMedicalRecord() {}
//     public function updateMedicalRecord() {}
//     public function deleteMedicalRecord() {}
//     public function viewMedicalRecord() {}
//     public function listMedicalRecord() {}

//     // Medical details updates
//     public function addAllergies() {}
//     public function updateTreatmentPlans() {}
// }


namespace App\Http\Controllers;

use App\Models\{MedicalRecord, Patient};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    /**
     * Display all medical records
     */
    public function index()
    {
        $records = MedicalRecord::all();
        return response()->json(['records' => $records], 200);
    }

    /**
     * Create a new medical record
     */
    public function createMedicalRecord(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosis' => 'required|string|max:255',
            'treatment_plan' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $medicalRecord = MedicalRecord::create([
            'patient_id' => $validated['patient_id'],
            'diagnosis' => $validated['diagnosis'],
            'treatment_plan' => $validated['treatment_plan'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json(['message' => 'Medical record created successfully', 'record' => $medicalRecord], 201);
    }

    /**
     * Update an existing medical record
     */
    public function updateMedicalRecord(Request $request, $recordId)
    {
        $validated = $request->validate([
            'diagnosis' => 'nullable|string|max:255',
            'treatment_plan' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $medicalRecord = MedicalRecord::find($recordId);
        if (!$medicalRecord) {
            return response()->json(['message' => 'Medical record not found'], 404);
        }

        $medicalRecord->update(array_filter($validated));

        return response()->json(['message' => 'Medical record updated successfully', 'record' => $medicalRecord], 200);
    }

    /**
     * Delete a medical record
     */
    public function deleteMedicalRecord($recordId)
    {
        $medicalRecord = MedicalRecord::find($recordId);
        if (!$medicalRecord) {
            return response()->json(['message' => 'Medical record not found'], 404);
        }

        $medicalRecord->delete();

        return response()->json(['message' => 'Medical record deleted successfully'], 200);
    }

    /**
     * View a specific medical record
     */
    public function viewMedicalRecord($recordId)
    {
        $medicalRecord = MedicalRecord::find($recordId);
        if (!$medicalRecord) {
            return response()->json(['message' => 'Medical record not found'], 404);
        }

        return response()->json(['record' => $medicalRecord], 200);
    }

    /**
     * List all medical records for a patient
     */
    public function listMedicalRecord($patientId)
    {
        $patient = Patient::find($patientId);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $records = MedicalRecord::where('patient_id', $patientId)->get();
        return response()->json(['records' => $records], 200);
    }

    /**
     * Add allergies to a medical record
     */
    public function addAllergies(Request $request, $recordId)
    {
        $validated = $request->validate([
            'allergies' => 'required|string|max:255',
        ]);

        $medicalRecord = MedicalRecord::find($recordId);
        if (!$medicalRecord) {
            return response()->json(['message' => 'Medical record not found'], 404);
        }

        $medicalRecord->allergies = $validated['allergies'];
        $medicalRecord->save();

        return response()->json(['message' => 'Allergies added successfully', 'record' => $medicalRecord], 200);
    }

    /**
     * Update the treatment plan in a medical record
     */
    public function updateTreatmentPlans(Request $request, $recordId)
    {
        $validated = $request->validate([
            'treatment_plan' => 'required|string|max:255',
        ]);

        $medicalRecord = MedicalRecord::find($recordId);
        if (!$medicalRecord) {
            return response()->json(['message' => 'Medical record not found'], 404);
        }

        $medicalRecord->treatment_plan = $validated['treatment_plan'];
        $medicalRecord->save();

        return response()->json(['message' => 'Treatment plan updated successfully', 'record' => $medicalRecord], 200);
    }
}
