<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
    //

    public function getContactForms(Request $request)
{
    // Optionnel : Ajouter des filtres selon les besoins, comme 'status' ou 'date'
    $contacts = ContactForm::query();

    if ($request->has('status')) {
        $contacts->where('status', $request->status);
    }

    if ($request->has('date_from') && $request->has('date_to')) {
        $contacts->whereBetween('created_at', [$request->date_from, $request->date_to]);
    }

    $contacts = $contacts->orderBy('created_at', 'desc')->get();

    return response()->json([
        'message' => 'Contact forms retrieved successfully',
        'data' => $contacts,
    ], 200);
}

public function showContactForm($id)
{
    $contact = ContactForm::find($id);

    if (!$contact) {
        return response()->json(['message' => 'Contact form not found'], 404);
    }

    return response()->json([
        'message' => 'Contact form retrieved successfully',
        'data' => $contact,
    ], 200);
}

public function markAsResolved($id)
{
    $contact = ContactForm::find($id);

    if (!$contact) {
        return response()->json(['message' => 'Contact form not found'], 404);
    }

    $contact->status = 'resolved'; // Exemple : 'resolved', 'pending', etc.
    $contact->save();

    return response()->json([
        'message' => 'Contact form marked as resolved successfully',
        'data' => $contact,
    ], 200);
}




}
