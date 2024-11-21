<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PatientSeeder::class,
            DoctorSeeder::class,
            AdministratorSeeder::class,
            AppointmentSeeder::class,
            MedicalRecordSeeder::class,
            PrescriptionSeeder::class,
            MedicationSeeder::class,
            PaymentSeeder::class,
            NotificationSeeder::class
        ]);
    }
}
