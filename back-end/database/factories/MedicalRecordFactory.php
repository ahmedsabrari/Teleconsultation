<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Administrator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
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
            'medical_history' => $this->faker->paragraph(),
            'allergies' => $this->faker->words(3, true),
            'current_treatments' => $this->faker->paragraph(),
            'updated_by' => Administrator::factory(),
            'last_updated' => $this->faker->dateTime(),
            'attachments' => json_encode([$this->faker->url(), $this->faker->url()]),
        ];
    }
}
