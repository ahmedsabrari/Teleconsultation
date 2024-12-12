<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'doctor_id' => Doctor::factory(),
            'appointment_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
            'appointment_type' => $this->faker->randomElement(['telemedicine', 'in-person']),
            'duration' => $this->faker->numberBetween(15, 60),
            'notes' => $this->faker->sentence(),
            'video_link' => $this->faker->url(),
            'cancelled_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
