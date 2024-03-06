<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Caverne;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Caverne>
 */
class CaverneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => Str::random(8),
            'image' =>Str::random(8),
            'audio' => Str::random(8),
        ];
    }
}
