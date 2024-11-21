<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'date_issued',
    ];

    // Relations
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function medications()
    {
        return $this->hasMany(Medication::class);
    }
}
