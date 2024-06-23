<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chapter;
use App\Models\ChapterComment;
use App\Models\ChapterCommentVote;
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
        $admin = User::factory()->create(["username" => "admin", "admin" => true]);

        $series = Series::factory(30)->create();

        $users = User::all();

        foreach ($series as $s) {
            for ($i = 0; $i < 20; ++$i) {
                $chapter = Chapter::factory()->createOne(["series_id" => $s->id]);

                if ($i > 10) {
                    for ($c = 0; $c < 10; $c++) {
                        $comment = ChapterComment::factory()->createOne([
                            "chapter_id" => $chapter->id,
                        ]);

                        for ($k = 0; $k < 10; $k++) {
                            ChapterCommentVote::create([
                                "user_id" => $users[$k]->id,
                                "chapter_comment_id" => $comment->id,
                                "vote" => random_int(0, 2) == 0 ? 1 : -1,
                            ]);
                        }
                    }
                }

                for ($j = 0; $j < 5; ++$j) {
                    Page::factory()->createOne(["chapter_id" => $chapter->id]);
                }
            }
        }
    }
}
