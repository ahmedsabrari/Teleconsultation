<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id', 'type', 'message', 'sent_date', 'read_at',
    ];

    // Relationships
    public function recipient()
    {
        return $this->belongsTo(Patient::class, 'recipient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'recipient_id');
    }
}
