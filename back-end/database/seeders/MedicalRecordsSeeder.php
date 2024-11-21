<?php

use Illuminate\Database\Seeder;
use App\Models\MedicalRecord;

class MedicalRecordsSeeder extends Seeder
{
    public function run()
    {
        MedicalRecord::factory(10)->create(); // Generates 10 medical records
    }
}
