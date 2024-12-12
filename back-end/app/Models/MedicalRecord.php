<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'medical_history', 'allergies', 'current_treatments', 'attachments', 'updated_by',
    ];
    protected $casts = [
        'attachments' => 'array',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(Administrator::class, 'updated_by');
    }
}
