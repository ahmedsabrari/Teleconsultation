<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'amount' => $this->faker->randomFloat(2, 50, 500),
            'payment_method' => $this->faker->randomElement(['credit_card', 'PayPal']),
            'transaction_id' => $this->faker->uuid(),
            'status' => $this->faker->randomElement(['completed', 'refunded']),
            'payment_date' => $this->faker->dateTime(),
        ];
    }
}
