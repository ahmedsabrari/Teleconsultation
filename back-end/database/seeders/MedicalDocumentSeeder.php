<?php

namespace Database\Seeders;

use App\Models\MedicalDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicalDocument::factory()->count(10)->create();
    }
}
