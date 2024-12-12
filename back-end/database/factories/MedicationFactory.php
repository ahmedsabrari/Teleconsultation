<?php

namespace Database\Factories;

use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medication>
 */
class MedicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prescription_id' => Prescription::factory(),
            'name' => $this->faker->word(),
            'dosage' => $this->faker->numberBetween(1, 500) . 'mg',
            'duration' => $this->faker->numberBetween(1, 30) . ' days',
        ];
    }
}
