<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'doctor_id', 'appointment_date', 'status', 'video_link', 'appointment_type', 'duration', 'notes',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }

    // Accessors
    public function getFormattedAppointmentDateAttribute()
    {
        return $this->appointment_date->format('d-m-Y H:i');
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('appointment_date', '>', now());
    }
}
