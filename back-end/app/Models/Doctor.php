<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'specialty', 'availability',
    ];

    protected $casts = [
        'availability' => 'array',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
