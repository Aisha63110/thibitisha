<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VerificationLog>
 */
class VerificationLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
 public function definition(): array
{
    $practitionerIds = \App\Models\Practitioner::pluck('id')->toArray();

    return [
        'practitioner_id' => !empty($practitionerIds)
            ? $this->faker->randomElement($practitionerIds)
            : \App\Models\Practitioner::factory(), // create one if none exist
        'ip_address' => $this->faker->ipv4(),
        'user_agent' => $this->faker->userAgent(),
        'is_valid' => $this->faker->boolean(),
        'verified_at' => $this->faker->dateTimeBetween(),
    ];
}

}