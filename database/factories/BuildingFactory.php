<?php

namespace Database\Factories;

use App\Models\Development;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Building>
 */
class BuildingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $developmentIds = Development::pluck('id')->toArray();
        $key = random_int(0, count($developmentIds)-1);
        return [
            'title_ru' => $this->faker->sentence(),
            'title_tt' => $this->faker->sentence(),

            'text_ru' => $this->faker->text(512),
            'text_tt' => $this->faker->text(512),

            'compatibility' => rand(0, 500),
            'development_id' => $developmentIds[$key]
        ];
    }
}
