<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Artist;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'artist_id' => Artist::all()->random()->id,
            'release_date' => fake()->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null)
        ];
    }
}
