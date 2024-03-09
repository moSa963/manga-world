<?php

namespace Tests\Feature;

use App\Models\Chapter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChapterListTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_page_can_be_rendered(): void
    {
        $chapter =  Chapter::factory()->createOne();

        $response = $this->get("/series/{$chapter->series->id}/chapter/{$chapter->number}");

        $chapter->series->delete();

        $response->assertStatus(200);
    }
}
