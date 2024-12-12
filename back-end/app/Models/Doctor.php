<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'specialty',
        'availability',
        'status',
        'profile_picture',
    ];

    protected $casts = [
        'availability' => 'array',
    ];

    protected $hidden = [
        'password',
    ];

    // Automatically hash passwords when setting
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Relationships
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}
