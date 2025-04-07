<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'album_id' => Album::all()->random()->id,
            'vote_type' => fake()->randomElement([1, -1]),
        ];
    }
}
