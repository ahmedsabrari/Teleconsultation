<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'name',
        'dosage',
        'duration',
    ];

    // Relations
    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
