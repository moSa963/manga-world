<?php

use App\Models\Chapter;

test('chapter page can be rendered', function () {
    $chapter =  Chapter::factory()->createOne();

    $response = $this->get("/series/{$chapter->series->id}/chapter/{$chapter->number}");

    $chapter->series->delete();

    $response->assertStatus(200);
});
