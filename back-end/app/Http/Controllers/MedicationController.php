<?php
// class MedicationController extends Controller
// {
//     // Medication management
//     public function addMedication() {}
//     public function updateMedication() {}
//     public function deleteMedication() {}

//     // Prescription-based medication listing
//     public function listMedicationsByPrescription() {}
// }


namespace App\Http\Controllers;

use App\Models\{Medication, Prescription};
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    /**
     * Display all medications
     */
    public function index()
    {
        $medications = Medication::all();
        return response()->json(['medications' => $medications], 200);
    }

    /**
     * Add a new medication to a prescription
     */
    public function addMedication(Request $request)
    {
        $validated = $request->validate([
            'prescription_id' => 'required|exists:prescriptions,id',
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $prescription = Prescription::find($validated['prescription_id']);
        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }

        $medication = Medication::create([
            'prescription_id' => $validated['prescription_id'],
            'name' => $validated['name'],
            'dosage' => $validated['dosage'],
            'duration' => $validated['duration'],
        ]);

        return response()->json(['message' => 'Medication added successfully', 'medication' => $medication], 201);
    }

    /**
     * Update an existing medication
     */
    public function updateMedication(Request $request, $medicationId)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'dosage' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
        ]);

        $medication = Medication::find($medicationId);
        if (!$medication) {
            return response()->json(['message' => 'Medication not found'], 404);
        }

        $medication->update(array_filter($validated));

        return response()->json(['message' => 'Medication updated successfully', 'medication' => $medication], 200);
    }

    /**
     * Delete a medication from a prescription
     */
    public function deleteMedication($medicationId)
    {
        $medication = Medication::find($medicationId);
        if (!$medication) {
            return response()->json(['message' => 'Medication not found'], 404);
        }

        $medication->delete();

        return response()->json(['message' => 'Medication deleted successfully'], 200);
    }

    /**
     * List all medications by a specific prescription ID
     */
    public function listMedicationsByPrescription($prescriptionId)
    {
        $medications = Medication::where('prescription_id', $prescriptionId)->get();
        if ($medications->isEmpty()) {
            return response()->json(['message' => 'No medications found for this prescription'], 404);
        }

        return response()->json(['medications' => $medications], 200);
    }
}
