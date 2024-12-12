<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;

Route::prefix('administrator')->group(function () {
    Route::post('register', [AdministratorController::class, 'registerAdmin']);
    Route::post('login', [AdministratorController::class, 'login']);
    Route::post('logout', [AdministratorController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('forgot-password', [AdministratorController::class, 'forgotPassword']);
    Route::post('reset-password', [AdministratorController::class, 'resetPassword']);
    Route::get('verify-email', [AdministratorController::class, 'verifyEmail']);
    Route::post('change-password', [AdministratorController::class, 'changePassword'])->middleware('auth:sanctum');
});


















// use App\Http\Controllers\AdministratorController;
// use App\Http\Controllers\AppointmentController;
// use App\Http\Controllers\DoctorController;
// use App\Http\Controllers\MedicalRecordController;
// use App\Http\Controllers\PatientController;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// // Laravel API Routes (Backend)

// // General Authentication
// Route::prefix('patient')->group(function() {
//     Route::get('/', [PatientController::class, 'index'])->name('patient.index'); // View patient profile
//     Route::post('register', [PatientController::class, 'register'])->name('patient.register'); // Register a new patient
//     Route::post('login', [PatientController::class, 'login'])->name('patient.login'); // Patient login
//     Route::post('logout', [PatientController::class, 'logout'])->name('patient.logout'); // Patient logout
//     Route::post('forgot-password', [PatientController::class, 'forgotPassword'])->name('patient.forgotPassword'); // Forgot password
//     Route::post('reset-password', [PatientController::class, 'resetPassword'])->name('patient.resetPassword'); // Reset password
//     Route::post('verify-email', [PatientController::class, 'verifyEmail'])->name('patient.verifyEmail'); // Email verification
//     Route::post('change-password', [PatientController::class, 'changePassword'])->name('patient.changePassword'); // Change password
//     Route::get('profile', [PatientController::class, 'viewProfile'])->name('patient.viewProfile'); // View profile
//     Route::put('profile', [PatientController::class, 'updateProfile'])->name('patient.updateProfile'); // Update profile
//     Route::post('appointments', [PatientController::class, 'bookAppointment'])->name('patient.bookAppointment'); // Book appointment
//     Route::delete('appointments/{appointmentId}', [PatientController::class, 'cancelAppointment'])->name('patient.cancelAppointment'); // Cancel appointment
//     Route::get('appointments/{appointmentId}', [PatientController::class, 'viewAppointmentDetails'])->name('patient.viewAppointmentDetails'); // View appointment details
//     Route::get('appointments', [PatientController::class, 'viewAppointments'])->name('patient.viewAppointments'); // View all appointments
//     Route::get('prescriptions', [PatientController::class, 'viewPrescriptions'])->name('patient.viewPrescriptions'); // View prescriptions
//     Route::get('doctors', [PatientController::class, 'viewDoctors'])->name('patient.viewDoctors'); // View doctors
//     Route::get('medical-history', [PatientController::class, 'viewMedicalHistory'])->name('patient.viewMedicalHistory'); // View medical history
//     Route::get('medical-records', [PatientController::class, 'viewMedicalRecords'])->name('patient.viewMedicalRecords'); // View medical records
//     Route::post('prescription-refill', [PatientController::class, 'requestPrescriptionRefill'])->name('patient.requestPrescriptionRefill'); // Request prescription refill
//     Route::get('notifications', [PatientController::class, 'notifications'])->name('patient.notifications'); // View notifications
//     Route::get('appointment-history', [PatientController::class, 'viewAppointmentHistory'])->name('patient.viewAppointmentHistory'); // View appointment history
// });

// Route::prefix('admin')->group(function() {
//     Route::post('login', [AdministratorController::class, 'login'])->name('admin.login'); // Admin login
//     Route::post('logout', [AdministratorController::class, 'logout'])->name('admin.logout'); // Admin logout
//     Route::post('register', [AdministratorController::class, 'registerAdmin'])->name('admin.register'); // Register admin
//     Route::post('forgot-password', [AdministratorController::class, 'forgotPassword'])->name('admin.forgotPassword'); // Forgot password
//     Route::post('reset-password', [AdministratorController::class, 'resetPassword'])->name('admin.resetPassword'); // Reset password
//     Route::post('verify-email', [AdministratorController::class, 'verifyEmail'])->name('admin.verifyEmail'); // Verify email
//     Route::post('change-password', [AdministratorController::class, 'changePassword'])->name('admin.changePassword'); // Change password
//     Route::get('users', [AdministratorController::class, 'manageUsers'])->name('admin.manageUsers'); // Manage users
//     Route::put('users/{userId}/role', [AdministratorController::class, 'updateUserRole'])->name('admin.updateUserRole'); // Update user role
//     Route::delete('users/{userId}', [AdministratorController::class, 'deleteUser'])->name('admin.deleteUser'); // Delete user
//     Route::get('appointments', [AdministratorController::class, 'viewAllAppointments'])->name('admin.viewAllAppointments'); // View all appointments
//     Route::get('doctors', [AdministratorController::class, 'manageDoctors'])->name('admin.manageDoctors'); // Manage doctors
//     Route::get('patients', [AdministratorController::class, 'managePatients'])->name('admin.managePatients'); // Manage patients
//     Route::get('dashboard', [AdministratorController::class, 'dashboardStatistics'])->name('admin.dashboardStatistics'); // View dashboard statistics
//     Route::get('reports', [AdministratorController::class, 'generateReports'])->name('admin.generateReports'); // Generate reports
// });

// Route::prefix('doctor')->group(function() {
//     Route::post('login', [DoctorController::class, 'login'])->name('doctor.login'); // Doctor login
//     Route::post('logout', [DoctorController::class, 'logout'])->name('doctor.logout'); // Doctor logout
//     Route::post('register', [DoctorController::class, 'registerDoctor'])->name('doctor.register'); // Register doctor
//     Route::post('forgot-password', [DoctorController::class, 'forgotPassword'])->name('doctor.forgotPassword'); // Forgot password
//     Route::post('reset-password', [DoctorController::class, 'resetPassword'])->name('doctor.resetPassword'); // Reset password
//     Route::post('verify-email', [DoctorController::class, 'verifyEmail'])->name('doctor.verifyEmail'); // Verify email
//     Route::post('change-password', [DoctorController::class, 'changePassword'])->name('doctor.changePassword'); // Change password
//     Route::get('profile', [DoctorController::class, 'viewProfile'])->name('doctor.viewProfile'); // View profile
//     Route::put('profile', [DoctorController::class, 'updateProfile'])->name('doctor.updateProfile'); // Update profile
//     Route::get('appointments', [DoctorController::class, 'listAppointments'])->name('doctor.listAppointments'); // List appointments
//     Route::get('appointments/{appointmentId}', [DoctorController::class, 'viewAppointmentDetails'])->name('doctor.viewAppointmentDetails'); // View appointment details
//     Route::post('appointments/{appointmentId}/accept', [DoctorController::class, 'acceptAppointment'])->name('doctor.acceptAppointment'); // Accept appointment
//     Route::post('appointments/{appointmentId}/decline', [DoctorController::class, 'declineAppointment'])->name('doctor.declineAppointment'); // Decline appointment
//     Route::get('patients/{patientId}/history', [DoctorController::class, 'viewMedicalHistory'])->name('doctor.viewMedicalHistory'); // View medical history of a patient
//     Route::post('appointments/{appointmentId}/consult', [DoctorController::class, 'consultPatient'])->name('doctor.consultPatient'); // Consult patient
//     Route::post('appointments/{appointmentId}/prescribe', [DoctorController::class, 'prescribeMedication'])->name('doctor.prescribeMedication'); // Prescribe medication
//     Route::post('appointments/{appointmentId}/report', [DoctorController::class, 'generateMedicalReports'])->name('doctor.generateMedicalReports'); // Generate medical reports
// });


// Route::prefix('appointments')->group(function() {
//     Route::get('/', [AppointmentController::class, 'index'])->name('appointments.index'); // View all appointments
//     Route::post('/', [AppointmentController::class, 'createAppointment'])->name('appointments.create'); // Create appointment
//     Route::put('{appointmentId}', [AppointmentController::class, 'updateAppointment'])->name('appointments.update'); // Update appointment
//     Route::delete('{appointmentId}', [AppointmentController::class, 'deleteAppointment'])->name('appointments.delete'); // Delete appointment
//     Route::get('{appointmentId}', [AppointmentController::class, 'viewAppointment'])->name('appointments.view'); // View appointment
//     Route::post('{appointmentId}/cancel', [AppointmentController::class, 'cancelAppointment'])->name('appointments.cancel'); // Cancel appointment
//     Route::post('{appointmentId}/reminder', [AppointmentController::class, 'sendAppointmentReminders'])->name('appointments.reminder'); // Send appointment reminder
//     Route::get('by-doctor/{doctorId}', [AppointmentController::class, 'listAppointmentsByDoctor'])->name('appointments.byDoctor'); // List appointments by doctor
//     Route::get('by-patient/{patientId}', [AppointmentController::class, 'listAppointmentsByPatient'])->name('appointments.byPatient'); // List appointments by patient
//     Route::post('{appointmentId}/video-link', [AppointmentController::class, 'manageVideoLinks'])->name('appointments.videoLink'); // Manage video links
// });


// Route::prefix('medical-records')->group(function() {
//     Route::get('/', [MedicalRecordController::class, 'index'])->name('medicalRecords.index'); // View all medical records
//     Route::post('/', [MedicalRecordController::class, 'createMedicalRecord'])->name('medicalRecords.create'); // Create new medical record
//     Route::put('{recordId}', [MedicalRecordController::class, 'updateMedicalRecord'])->name('medicalRecords.update'); // Update medical record
//     Route::delete('{recordId}', [MedicalRecordController::class, 'deleteMedicalRecord'])->name('medicalRecords.delete'); // Delete medical record
//     Route::get('{recordId}', [MedicalRecordController::class, 'viewMedicalRecord'])->name('medicalRecords.view'); // View specific medical record
//     Route::post('{recordId}/allergies', [MedicalRecordController::class, 'addAllergies'])->name('medicalRecords.addAllergies'); // Add allergies to record
//     Route::post('{recordId}/treatment', [MedicalRecordController::class, 'updateTreatmentPlans'])->name('medicalRecords.updateTreatmentPlans'); // Update treatment plans
// });
