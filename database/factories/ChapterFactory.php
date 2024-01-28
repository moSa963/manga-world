<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\Series;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "series_id" => null,
            "title" => $this->faker->title(),
            "published" => true,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function(Chapter $chappter) {
            if ($chappter->series_id == null){
                $chappter->series_id = Series::factory()->createOne()->id;
            }
        });
    }
}
