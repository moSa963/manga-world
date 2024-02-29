<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chapter;
use App\Models\Page;
use App\Models\Series;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(["username" => "admin"]);

        $series = Series::factory(10)->create();

        foreach ($series as $s) {
            for ($i = 0; $i < 5; ++$i) {
                $chapter = Chapter::factory()->createOne(["series_id" => $s->id]);
                for ($i = 0; $i < 5; ++$i) {
                    Page::factory()->createOne(["chapter_id" => $chapter->id]);
                }
            }
        }
    }
}
