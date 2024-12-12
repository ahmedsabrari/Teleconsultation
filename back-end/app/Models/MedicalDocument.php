<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id', 'title', 'type', 'file_path',
    ];

    // Relationships
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
