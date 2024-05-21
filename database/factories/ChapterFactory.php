<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\Series;
use App\Models\User;
use Carbon\Carbon;
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
            "user_id" => null,
            "number" => null,
            "title" => $this->faker->name(),
            "published" => true,
            "release_date" => Carbon::now(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Chapter $chapter) {
            if ($chapter->series_id == null) {
                $chapter->series_id = Series::factory()->createOne()->id;
            }
            if ($chapter->user_id == null) {
                $chapter->user_id = User::factory()->createOne()->id;
            }
            if ($chapter->number == null) {
                $chapter->number = $chapter->series->chapters()->count();
            }
        });
    }
}
