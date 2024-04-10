<?php

use App\Models\Series;
use function Pest\Laravel\get;

test('user can search for series', function () {
    $key = "onePiece";

    Series::factory()->createOne([
        "title" => "oneePiece2",
        "other_names" => "onePiece",
        "author" => "onePiecce",
    ]);

    Series::factory()->createOne([
        "title" => "onePiece",
        "other_names" => "oneePiece",
        "author" => "onePiecce",
    ]);

    Series::factory()->createOne([
        "title" => "onePiecce3",
        "other_names" => "oneePiece",
        "author" => "onePiece",
    ]);

    Series::factory()->createOne([
        "title" => "onsePiece4",
        "other_names" => "onePietce",
        "author" => "onwePiece",
    ]);

    $response = get("api/search/series/{$key}");

    $response->assertStatus(200);
    $response->assertJsonCount(3, "data");
    $response->assertJsonPath("data.0.title", "oneePiece2");
    $response->assertJsonPath("data.1.title", "onePiece");
    $response->assertJsonPath("data.2.title", "onePiecce3");
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
