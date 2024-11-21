<?php

use Illuminate\Database\Seeder;
use App\Models\Medication;

class MedicationsSeeder extends Seeder
{
    public function run()
    {
        Medication::factory(30)->create(); // Generates 30 medications
    }
}

