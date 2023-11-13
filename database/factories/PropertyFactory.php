<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ptype_id' => fake()->numberBetween(1, 9),
            'amenities_id' => fake()->numberBetween(1, 6),
            'property_name' => fake()->firstName . ' ' . fake()->lastName,
            'property_slug' => fake()->slug,
            'property_code' => fake()->uuid,
            'property_status' => fake()->randomElement(['buy', 'rent']),
            'lowest_price' => fake()->randomNumber(4),
            'maximum_price' => fake()->randomNumber(5),
            'property_thumbnail' => fake()->imageUrl(370,250),
            'short_description' => fake()->sentence,
            'long_description' => fake()->paragraph,
            'bedrooms' => fake()->numberBetween(2, 9),
            'bathrooms' => fake()->numberBetween(1, 4),
            // 'garage' => fake()->randomDigit,
            'garage' => fake()->numberBetween(1, 3),
            'garage_size' => fake()->randomNumber(4),
            'property_size' => fake()->numberBetween(500, 4000),
            'property_video' => fake()->url,
            'address' => fake()->address,
            'city' => fake()->city,
            'state' => fake()->state,
            'postal_code' => fake()->postcode,
            'neighborhood' => fake()->word,
            'latitude' => fake()->latitude,
            'longitude' => fake()->longitude,
            // 'featured' => fake()->boolean,
            'featured' => '1',
            'hot' => '1',
            'agent_id' => fake()->numberBetween(1, 10),
            'status' => fake()->numberBetween(0, 1),
        ];
    }
}
