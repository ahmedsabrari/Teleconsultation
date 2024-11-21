<?php

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorsSeeder extends Seeder
{
    public function run()
    {
        Doctor::factory(10)->create(); // Generates 10 doctors
    }
}
