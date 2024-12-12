<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalDocument>
 */
class MedicalDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medical_record_id' => MedicalRecord::factory(),
            'title' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['PDF', 'Image']),
            'file_path' => $this->faker->filePath(),
        ];
    }
}
