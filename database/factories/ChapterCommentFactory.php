<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\ChapterComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChapterComment>
 */
class ChapterCommentFactory extends Factory
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
            "chapter_id" => null,
            "comment" => $this->faker->paragraph(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (ChapterComment $chapterComment) {
            if ($chapterComment->user_id == null) {
                $chapterComment->user_id = User::factory()->createOne()->id;
            }
            if ($chapterComment->chapter_id == null) {
                $chapterComment->chapter_id = Chapter::factory()->createOne()->id;
            }
        });
    }
}
