<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'date_issued', 'doctor_notes', 'status',
    ];

    // Relationships
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function medications()
    {
        return $this->hasMany(Medication::class);
    }

    public function issuedBy()
    {
        return $this->belongsTo(Doctor::class, 'issued_by');
    }
}
