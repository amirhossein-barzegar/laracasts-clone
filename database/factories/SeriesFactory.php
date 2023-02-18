<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Normalizer\SlugNormalizer;
use App\Models\Series;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class SeriesFactory extends Factory
{

    protected $model = Series::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sluger = new SlugNormalizer;
        $title = fake()->sentence(5);
        return [
            'title' => $title,
            'slug' => $sluger->normalize($title),
            'image_url' => fake()->imageUrl(),
            'description' => fake()->paragraph()
        ];
    }
}
