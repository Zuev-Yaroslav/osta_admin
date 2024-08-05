<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MosqueHistory>
 */
class MosqueHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ru' => $this->faker->sentence(),
            'title_tt' => $this->faker->sentence(),

            'text_ru' => $this->faker->text(),
            'text_tt' => $this->faker->text(),
        ];
    }
}
