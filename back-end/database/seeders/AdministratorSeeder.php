<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrator::factory()->create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@teleconsultation.com',
            'password' => bcrypt('admin123'), // Predefined admin user
            'role' => 'Admin',
        ]);

        Administrator::factory()->count(10)->create();
    }
}
