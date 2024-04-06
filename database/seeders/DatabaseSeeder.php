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
        User::factory()->create(["username" => "admin", "admin" => true]);

        $series = Series::factory(30)->create();

        foreach ($series as $s) {
            for ($i = 0; $i < 50; ++$i) {
                $chapter = Chapter::factory()->createOne(["series_id" => $s->id]);
                for ($j = 0; $j < 5; ++$j) {
                    Page::factory()->createOne(["chapter_id" => $chapter->id]);
                }
            }
        }
    }
}
