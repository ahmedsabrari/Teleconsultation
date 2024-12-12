<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'created_by',
    ];

    // Relationships
    public function createdBy()
    {
        return $this->belongsTo(Administrator::class, 'created_by');
    }

    // Relationships
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
