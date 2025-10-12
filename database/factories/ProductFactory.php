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
            'name' => fake()->name(),
            'description' => fake()->text(),
            'important_information' => fake()->text(),
            'visitor_count' => fake()->numberBetween(1, 10000),
            'contacts' => [
                [
                    'platform' => ContactPlatform::INSTAGRAM->value,
                    'url' => 'https:/instagram.com/nanda_amanta',
                ],
            ],
            'user_id' => User::factory()->create()->id,
            'is_active' => true,
        ];
    }
}
