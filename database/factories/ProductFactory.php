<?php

namespace Database\Factories;

use App\Enums\ContactPlatform;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucwords(fake()->words(3, true)),
            'description' => fake()->text(200),
            'important_information' => fake()->text(200),
            'visitor_count' => fake()->numberBetween(1, 10000),
            'contacts' => [
                [
                    'platform' => ContactPlatform::INSTAGRAM->value,
                    'url' => 'https://instagram.com/jehemmeadolan',
                ],
            ],
            'user_id' => User::factory(),
            'is_active' => true,
            'is_approved' => false,
        ];
    }

    /**
     * A product that has been approved by an admin and is visible on the public site.
     */
    public function approved(): static
    {
        return $this->state(fn () => ['is_approved' => true]);
    }
}
