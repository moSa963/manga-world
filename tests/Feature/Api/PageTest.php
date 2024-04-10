<?php

use App\Models\Chapter;
use App\Models\Page;
use App\Models\Series;

test('user can get a list of chapters', function () {
    $series = Series::factory()->createOne();
    $chapter = Chapter::factory()->createOne(["series_id" => $series->id]);

    Page::factory()->createOne(["chapter_id" => $chapter->id]);

    $page = Page::factory()->createOne(["chapter_id" => $chapter->id]);

    Page::factory()->createOne(["chapter_id" => $chapter->id]);

    $response = $this->get("api/series/{$series->id}/chapter/{$chapter->number}/page/{$page->number}");

    $response->assertSuccessful();
});


afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
