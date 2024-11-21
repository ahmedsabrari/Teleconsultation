<?php

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentsSeeder extends Seeder
{
    public function run()
    {
        Appointment::factory(20)->create(); // Generates 20 appointments
    }
}

