<?php

namespace Tests\Feature\Api;

use App\Models\Chapter;
use App\Models\Page;
use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_a_list_of_chapters(): void
    {
        $series = Series::factory()->createOne();
        $chapter = Chapter::factory()->createOne(["series_id" => $series->id]);

        Page::factory()->createOne(["chapter_id" => $chapter->id]);

        $page = Page::factory()->createOne(["chapter_id" => $chapter->id]);

        Page::factory()->createOne(["chapter_id" => $chapter->id]);

        $response = $this->get("api/series/{$series->id}/chapter/{$chapter->number}/page/{$page->number}");

        $series->delete();

        $response->assertSuccessful();
    }
}
