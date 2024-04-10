<?php

use App\Models\Chapter;
use App\Models\Series;

test('user can get a list of chapters', function () {
    $series = Series::factory()->createOne();
    Chapter::factory()->createOne(["series_id" => $series->id]);
    Chapter::factory()->createOne(["series_id" => $series->id]);
    Chapter::factory(3)->create();

    $response = $this->get("api/series/{$series->id}/chapters");

    $response->assertSuccessful();

    $response->assertJsonCount(2, 'data');
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
