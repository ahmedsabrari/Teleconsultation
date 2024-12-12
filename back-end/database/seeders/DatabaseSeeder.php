<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdministratorSeeder::class,
            PatientSeeder::class,
            DoctorSeeder::class,
            AppointmentSeeder::class,
            MedicalRecordSeeder::class,
            PrescriptionSeeder::class,
            MedicationSeeder::class,
            NotificationSeeder::class,
            PaymentSeeder::class,
            ReportSeeder::class,
            DoctorScheduleSeeder::class,
            MedicalDocumentSeeder::class
        ]);
    }
}
