<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MosqueHistoryImage>
 */
class MosqueHistoryImageFactory extends Factory
{
    protected $index = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->index++;
        return [
            'alt_ru' => $this->faker->word,
            'alt_tt' => $this->faker->word,
            'src' => 'img/image1.webp',
            'sort_index' => $this->index - 1,
        ];
    }
}
