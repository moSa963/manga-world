<?php

use App\Models\Chapter;

test('series page can be rendered', function () {
    $chapter =  Chapter::factory()->createOne();

    $response = $this->get("/series/{$chapter->series->id}");

    $chapter->series->delete();

    $response->assertStatus(200);
});

test("list page can be rendered", function () {
    $response = $this->get('/series');

    $response->assertStatus(200);
});
