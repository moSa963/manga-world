<?php

use App\Models\Series;

test('index page can be rendered', function () {
    Series::factory(5)->create();

    $response = $this->get("/");

    $response->assertStatus(200);
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
