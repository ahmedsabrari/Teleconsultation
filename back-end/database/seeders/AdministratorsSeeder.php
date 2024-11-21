<?php

use Illuminate\Database\Seeder;
use App\Models\Administrator;

class AdministratorsSeeder extends Seeder
{
    public function run()
    {
        Administrator::factory(5)->create(); // Generates 5 administrators
    }
}
