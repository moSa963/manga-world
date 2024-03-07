<?php

namespace Tests\Feature\Api;

use App\Models\Chapter;
use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChapterListTest extends TestCase
{
    use RefreshDatabase;


    public function test_user_can_get_a_list_of_chapters(): void
    {
        $series = Series::factory()->createOne();
        Chapter::factory()->createOne(["series_id" => $series->id]);
        Chapter::factory()->createOne(["series_id" => $series->id]);
        Chapter::factory(3)->create();

        $response = $this->get("api/series/{$series->id}/chapters");

        foreach (Series::all() as $s) {
            $s->delete();
        }

        $response->assertSuccessful();

        $response->assertJsonCount(2, 'data');
    }
}
