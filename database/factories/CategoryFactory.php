<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(rand(1,3), true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'thumbnail' => 'https://source.unsplash.com/random/250x250/?fruits,drinks&'.rand(2,421342)
        ];
    }
}
