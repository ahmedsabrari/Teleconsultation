<?php

namespace Database\Factories;

use App\Models\Administrator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'specialty' => $this->faker->jobTitle(),
            'phone' => $this->faker->phoneNumber(),
            'availability' => json_encode($this->faker->randomElements(['Monday', 'Tuesday', 'Wednesday'], 2)),
            'profile_picture' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['available', 'on_leave', 'unavailable']),
            'hospital_affiliation' => $this->faker->company(),
            'years_of_experience' => $this->faker->numberBetween(1, 30),
            'created_by' => Administrator::factory(),
        ];
    }
}
