<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id',
        'type',  // reminder, confirmation, alert
        'message',
        'sent_date',
    ];

    // Relations
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'recipient_id');
    }
}
