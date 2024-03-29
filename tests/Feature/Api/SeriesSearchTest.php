<?php

namespace Tests\Feature\Api;

use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_search_for_series(): void
    {
        $key = "onePiece";

        $s1 = Series::factory()->createOne([
            "title" => "oneePiece2",
            "other_names" => "onePiece",
            "author" => "onePiecce",
        ]);

        $s2 = Series::factory()->createOne([
            "title" => "onePiece",
            "other_names" => "oneePiece",
            "author" => "onePiecce",
        ]);

        $s3 = Series::factory()->createOne([
            "title" => "onePiecce3",
            "other_names" => "oneePiece",
            "author" => "onePiece",
        ]);

        $s4 = Series::factory()->createOne([
            "title" => "onsePiece4",
            "other_names" => "onePietce",
            "author" => "onwePiece",
        ]);

        $response = $this->get("api/search/series/{$key}");

        $s1->delete();
        $s2->delete();
        $s3->delete();
        $s4->delete();

        $response->assertStatus(200);
        $response->assertJsonCount(3, "data");
        $response->assertJsonPath("data.0.title", "oneePiece2");
        $response->assertJsonPath("data.1.title", "onePiece");
        $response->assertJsonPath("data.2.title", "onePiecce3");
    }
}
