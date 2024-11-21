<?php

use App\Models\Payment;
use Illuminate\Database\Seeder;


class PaymentsSeeder extends Seeder
{
    public function run()
    {
        Payment::factory(20)->create(); // Generates 20 payments
    }
}

