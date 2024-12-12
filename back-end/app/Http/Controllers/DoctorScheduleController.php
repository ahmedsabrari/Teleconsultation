<?php
// class DoctorScheduleController extends Controller
// {
//     // Schedule management
//     public function createSchedule() {}
//     public function updateSchedule() {}
//     public function deleteSchedule() {}

//     // Viewing schedules
//     public function viewScheduleByDoctor() {}
// }

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorScheduleController extends Controller
{
    /**
     * Display all schedules (Admin/Doctor can view schedules)
     */
    public function index()
    {
        // Fetch all schedules
        $schedules = Schedule::all();

        if ($schedules->isEmpty()) {
            return response()->json(['message' => 'No schedules available'], 404);
        }

        return response()->json(['schedules' => $schedules], 200);
    }

    /**
     * Create a new schedule for a doctor
     */
    public function createSchedule(Request $request, $doctorId)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Check if doctor exists
        $doctor = Doctor::find($doctorId);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        // Create the schedule
        $schedule = new Schedule();
        $schedule->doctor_id = $doctorId;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->day_of_week = $request->day_of_week;
        $schedule->save();

        return response()->json(['message' => 'Schedule created successfully', 'schedule' => $schedule], 201);
    }

    /**
     * Update an existing schedule for a doctor
     */
    public function updateSchedule(Request $request, $scheduleId)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Find the schedule
        $schedule = Schedule::find($scheduleId);
        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        // Update the schedule details
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->day_of_week = $request->day_of_week;
        $schedule->save();

        return response()->json(['message' => 'Schedule updated successfully', 'schedule' => $schedule], 200);
    }

    /**
     * Delete an existing schedule for a doctor
     */
    public function deleteSchedule($scheduleId)
    {
        // Find the schedule to delete
        $schedule = Schedule::find($scheduleId);
        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        // Delete the schedule
        $schedule->delete();

        return response()->json(['message' => 'Schedule deleted successfully'], 200);
    }

    /**
     * View schedule for a specific doctor
     */
    public function viewScheduleByDoctor($doctorId)
    {
        // Check if the doctor exists
        $doctor = Doctor::find($doctorId);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        // Retrieve the doctor's schedule
        $schedule = Schedule::where('doctor_id', $doctorId)->get();

        if ($schedule->isEmpty()) {
            return response()->json(['message' => 'No schedule available for this doctor'], 404);
        }

        return response()->json(['doctor_name' => $doctor->name, 'schedule' => $schedule], 200);
    }
}
