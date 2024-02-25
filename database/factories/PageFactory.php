<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\Page;
use App\Services\StoragePathService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "chapter_id" => null,
            "name" => Random::generate(30),
            "number" => null,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Page $page) {
            if ($page->chapter_id == null) {
                $page->chapter_id = Chapter::factory()->createOne()->id;
            }
            if ($page->number == null) {
                $page->number = $page->chapter->pages()->count();
            }
        })
            ->afterCreating(function (Page $page) {
                $pages = Storage::allFiles("seeding_resources/pages");

                $pr = $pages[rand(0, count($pages) - 1)];

                Storage::copy($pr, StoragePathService::forPage($page) . $page->name);
            });
    }
}
