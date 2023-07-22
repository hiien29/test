<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testlist>
 */
class TestlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'make_day' => fake()->date(),
            'test_day' => fake()->date(),
            'age' => fake()->numberBetween(1, 100),
            'type' => fake()->word(),
            'site' => fake()->text(20),
            'result' => fake()->text(20),
            'author' => fake()->text(20),
            'editor' => fake()->text(20),
            'tester' => fake()->text(20),
            'test_editor' => fake()->text(20),
            'comment' => fake()->text(),
            ];
    }
}
