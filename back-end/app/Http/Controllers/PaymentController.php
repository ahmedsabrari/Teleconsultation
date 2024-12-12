<?php
// class PaymentController extends Controller
// {
//     // Payment management
//     public function processPayment() {}
//     public function issueRefund() {}
//     public function refundPayment() {}
//     public function validateTransaction() {}

//     // Payment history and details
//     public function viewPaymentHistory() {}
//     public function viewPaymentDetails() {}

//     // Subscription management
//     public function manageSubscriptions() {}

//     // Payment listing
//     public function listPaymentsByAppointment() {}
// }

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Appointment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display all payments (Admin view)
     */
    public function index()
    {
        $payments = Payment::all();
        return response()->json(['payments' => $payments], 200);
    }

    /**
     * Process a new payment
     */
    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string',
            'transaction_id' => 'required|string|unique:payments,transaction_id',
        ]);

        $appointment = Appointment::findOrFail($validated['appointment_id']);

        // Assuming the payment gateway is successful, save the payment
        $payment = Payment::create([
            'appointment_id' => $validated['appointment_id'],
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $validated['transaction_id'],
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        return response()->json(['message' => 'Payment processed successfully', 'payment' => $payment], 201);
    }

    /**
     * View the payment history for a user (patient or doctor)
     */
    public function viewPaymentHistory($userId)
    {
        $payments = Payment::where('user_id', $userId)->get();

        if ($payments->isEmpty()) {
            return response()->json(['message' => 'No payment history found for this user'], 404);
        }

        return response()->json(['payments' => $payments], 200);
    }

    /**
     * Issue a refund for a payment
     */
    public function issueRefund($paymentId)
    {
        $payment = Payment::find($paymentId);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Refund logic (could involve calling a payment gateway API)
        $payment->update(['status' => 'refunded', 'refunded_at' => now()]);

        return response()->json(['message' => 'Refund processed successfully', 'payment' => $payment], 200);
    }

    /**
     * Validate a payment transaction
     */
    public function validateTransaction(Request $request, $transactionId)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|string|exists:payments,transaction_id',
        ]);

        $transaction = Payment::where('transaction_id', $transactionId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json(['transaction' => $transaction], 200);
    }

    /**
     * Manage subscriptions (for patients or doctors)
     */
    public function manageSubscriptions(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Logic for handling subscriptions
        // This could involve adding a subscription to a subscription table
        // Assuming the user is a patient or doctor and has a subscription model

        return response()->json(['message' => 'Subscription managed successfully'], 200);
    }

    /**
     * View details of a specific payment
     */
    public function viewPaymentDetails($paymentId)
    {
        $payment = Payment::find($paymentId);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json(['payment' => $payment], 200);
    }

    /**
     * Refund a payment
     */
    public function refundPayment(Request $request, $paymentId)
    {
        $payment = Payment::find($paymentId);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Assuming refund logic here (could call an external API)
        $payment->update(['status' => 'refunded', 'refunded_at' => now()]);

        return response()->json(['message' => 'Refund processed successfully', 'payment' => $payment], 200);
    }

    /**
     * List all payments for a specific appointment
     */
    public function listPaymentsByAppointment($appointmentId)
    {
        $payments = Payment::where('appointment_id', $appointmentId)->get();

        if ($payments->isEmpty()) {
            return response()->json(['message' => 'No payments found for this appointment'], 404);
        }

        return response()->json(['payments' => $payments], 200);
    }
}
