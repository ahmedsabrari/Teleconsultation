<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role',
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
    public function createdPatients()
    {
        return $this->hasMany(Patient::class, 'created_by');
    }

    public function createdDoctors()
    {
        return $this->hasMany(Doctor::class, 'created_by');
    }
}
