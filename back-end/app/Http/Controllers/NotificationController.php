<?php
// class NotificationController extends Controller
// {
//     // Notification management
//     public function createNotification() {}
//     public function updateNotification() {}
//     public function deleteNotification() {}

//     // Notification viewing
//     public function viewNotifications() {}
//     public function viewNotificationsByRecipient() {}

//     // Notification status
//     public function markAsRead() {}

//     // Sending notifications
//     public function sendNotification() {}
// }


namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a list of all notifications
     */
    public function index()
    {
        $notifications = Notification::all();
        return response()->json(['notifications' => $notifications], 200);
    }

    /**
     * Create a new notification
     */
    public function createNotification(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:patients,id|exists:doctors,id',
            'type' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $recipient = Patient::find($validated['recipient_id']) ?? Doctor::find($validated['recipient_id']);

        if (!$recipient) {
            return response()->json(['message' => 'Recipient not found'], 404);
        }

        $notification = Notification::create([
            'recipient_id' => $validated['recipient_id'],
            'type' => $validated['type'],
            'message' => $validated['message'],
            'sent_date' => now(),
        ]);

        return response()->json(['message' => 'Notification created successfully', 'notification' => $notification], 201);
    }

    /**
     * Update an existing notification
     */
    public function updateNotification(Request $request, $notificationId)
    {
        $validated = $request->validate([
            'message' => 'nullable|string',
            'read_at' => 'nullable|date',
        ]);

        $notification = Notification::find($notificationId);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->update(array_filter($validated));

        return response()->json(['message' => 'Notification updated successfully', 'notification' => $notification], 200);
    }

    /**
     * View notifications by recipient (either patient or doctor)
     */
    public function viewNotificationsByRecipient($recipientId)
    {
        $notifications = Notification::where('recipient_id', $recipientId)->get();

        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No notifications found for this recipient'], 404);
        }

        return response()->json(['notifications' => $notifications], 200);
    }

    /**
     * Send a notification to a recipient
     */
    public function sendNotification(Request $request)
    {
        // Here you could include additional logic for actually sending notifications
        return response()->json(['message' => 'Notification sent successfully'], 200);
    }

    /**
     * View all notifications (Admin can view all notifications)
     */
    public function viewNotifications()
    {
        $notifications = Notification::all();
        return response()->json(['notifications' => $notifications], 200);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->update(['read_at' => now()]);
        return response()->json(['message' => 'Notification marked as read', 'notification' => $notification], 200);
    }

    /**
     * Delete a notification
     */
    public function deleteNotification($notificationId)
    {
        $notification = Notification::find($notificationId);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();
        return response()->json(['message' => 'Notification deleted successfully'], 200);
    }
}
