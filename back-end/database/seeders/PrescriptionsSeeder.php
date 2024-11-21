<?php

use App\Models\Prescription;
use Illuminate\Database\Seeder;


class PrescriptionsSeeder extends Seeder
{
    public function run()
    {
        Prescription::factory(10)->create(); // Generates 10 prescriptions
    }
}
