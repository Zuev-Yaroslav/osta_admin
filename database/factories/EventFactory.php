<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
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

            'text_ru' => $this->faker->text(512),
            'text_tt' => $this->faker->text(512),

            'image' => 'img/image1.webp'
        ];
    }
}
