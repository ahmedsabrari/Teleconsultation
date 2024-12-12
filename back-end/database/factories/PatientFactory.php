<?php

namespace Database\Factories;

use App\Models\Administrator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
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
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'date_of_birth' => $this->faker->date(),
            'phone_verified' => $this->faker->boolean(),
            'profile_picture' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['active', 'inactive', 'deactivated']),
            'created_by' => Administrator::factory(),
        ];
    }
}
