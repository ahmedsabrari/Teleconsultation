<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'date_issued' => $this->faker->date(),
            'doctor_notes' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'fulfilled', 'cancelled']),
        ];
    }
}
