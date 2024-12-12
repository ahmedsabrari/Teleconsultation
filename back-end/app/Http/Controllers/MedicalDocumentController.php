<?php
// class MedicalDocumentController extends Controller
// {
//     // Document management
//     public function uploadDocument() {}
//     public function updateDocument() {}
//     public function deleteDocument() {}

//     // Document viewing
//     public function viewDocumentDetails() {}
//     public function listDocumentsByPatient() {}
// }


namespace App\Http\Controllers;

use App\Models\MedicalDocument;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MedicalDocumentController extends Controller
{
    /**
     * Display all medical documents.
     */
    public function index()
    {
        // Fetch all medical documents
        $documents = MedicalDocument::all();

        if ($documents->isEmpty()) {
            return response()->json(['message' => 'No medical documents available'], 404);
        }

        return response()->json(['documents' => $documents], 200);
    }

    /**
     * Upload a new medical document.
     */
    public function uploadDocument(Request $request, $patientId)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'document' => 'required|file|mimes:pdf,doc,docx,jpg,png,jpeg|max:10240',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Check if the patient exists
        $patient = Patient::find($patientId);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        // Store the document
        $documentPath = $request->file('document')->store('medical_documents');

        // Create a new medical document entry
        $document = new MedicalDocument();
        $document->patient_id = $patientId;
        $document->document_path = $documentPath;
        $document->description = $request->description;
        $document->save();

        return response()->json(['message' => 'Document uploaded successfully', 'document' => $document], 201);
    }

    /**
     * Update a medical document (e.g., change description).
     */
    public function updateDocument(Request $request, $documentId)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Find the document to update
        $document = MedicalDocument::find($documentId);
        if (!$document) {
            return response()->json(['message' => 'Document not found'], 404);
        }

        // Update document details
        if ($request->has('description')) {
            $document->description = $request->description;
        }
        $document->save();

        return response()->json(['message' => 'Document updated successfully', 'document' => $document], 200);
    }

    /**
     * Delete a medical document.
     */
    public function deleteDocument($documentId)
    {
        // Find the document to delete
        $document = MedicalDocument::find($documentId);
        if (!$document) {
            return response()->json(['message' => 'Document not found'], 404);
        }

        // Delete the document file from storage
        Storage::delete($document->document_path);

        // Delete the document entry from the database
        $document->delete();

        return response()->json(['message' => 'Document deleted successfully'], 200);
    }

    /**
     * View details of a specific document.
     */
    public function viewDocumentDetails($documentId)
    {
        // Find the document
        $document = MedicalDocument::find($documentId);
        if (!$document) {
            return response()->json(['message' => 'Document not found'], 404);
        }

        return response()->json(['document' => $document], 200);
    }

    /**
     * List all medical documents for a specific patient.
     */
    public function listDocumentsByPatient($patientId)
    {
        // Check if the patient exists
        $patient = Patient::find($patientId);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        // Retrieve all documents for the patient
        $documents = MedicalDocument::where('patient_id', $patientId)->get();

        if ($documents->isEmpty()) {
            return response()->json(['message' => 'No documents found for this patient'], 404);
        }

        return response()->json(['documents' => $documents], 200);
    }
}
