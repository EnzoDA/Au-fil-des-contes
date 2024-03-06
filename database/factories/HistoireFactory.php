<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Histoire;
use App\Models\Caverne;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Histoire>
 */
class HistoireFactory extends Factory
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
            'auteur' => Str::random(8),
            'editeur' =>Str::random(8),
            'nb_vue' => $this->faker->randomDigit(),
            'note' => $this->faker->randomDigit(),
            'nb_notes' => $this->faker->randomDigit(),
            'caverne_id'=>Caverne::inRandomOrder()->first()->id,
        ];
    }
}
