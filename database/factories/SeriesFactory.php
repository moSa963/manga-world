<?php

namespace Database\Factories;

use App\Enums\SeriesStatus;
use App\Enums\SeriesTypes;
use App\Models\Series;
use App\Models\User;
use App\Services\StoragePathService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class SeriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => null,
            "title" => $this->faker->unique()->name(),
            "description" => $this->faker->paragraph(),
            "painter" => $this->faker->name(),
            "author" => $this->faker->name(),
            "other_names" => $this->faker->name(),
            "type" => SeriesTypes::MANGA,
            "status" => SeriesStatus::ONGOING,
            "release_date" => Carbon::now(),
            "published" => true,
            "genres" => ["shonen", "comedy", "action"][rand(0, 2)]
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Series $series) {
            if ($series->user_id == null) {
                $series->user_id = User::factory()->createOne()->id;
            }
            if (str_ends_with($series->title, ".")) {
                $series->title = $series->title . "A";
            }
        })
            ->afterCreating(function (Series $series) {
                $posters = Storage::allFiles("seeding_resources/posters");

                $poster = $posters[rand(0, count($posters) - 1)];

                Storage::copy($poster, StoragePathService::forPoster($series));
            });
    }
}
