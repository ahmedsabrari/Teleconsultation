<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'specialty',
        'phone',
        'availability',
    ];

    // Relations
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
