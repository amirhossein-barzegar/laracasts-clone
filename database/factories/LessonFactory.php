<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Series;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(3),
            'series_id' => function() {
                return Series::factory()->create()->id;
            },
            'episode_number' => 100,
            'video_id' => '2408038092'
        ];
    }
}
