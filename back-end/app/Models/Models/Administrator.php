<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role', // 'admin', 'superadmin'
    ];

    // Relations (optional, if needed)
    // public function manageDoctors()
    // {
    //     return $this->hasMany(Doctor::class);
    // }
}
