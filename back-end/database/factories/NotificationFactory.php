<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'recipient_id' => Patient::factory(),
            'type' => $this->faker->randomElement(['reminder', 'confirmation', 'alert']),
            'message' => $this->faker->sentence(),
            'read_at' => $this->faker->optional()->dateTime(),
            'sent_date' => $this->faker->dateTime(),
        ];
    }
}
