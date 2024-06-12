<?php

use App\Models\Chapter;
use App\Models\ChapterComment;
use App\Models\Series;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('user can get a chapters comments', function () {
    $chapter = Chapter::factory()->createOne();

    ChapterComment::factory(3)->create(["chapter_id" => $chapter->id]);

    $response = $this->get(route('api.chapter.comments.list', [
        "chapter" => $chapter->number,
        "series" => $chapter->series->id,
    ]));

    $response->assertOk();
    $response->assertJsonCount(3, "data");
});

test('user can store a new chapters comment', function () {
    $chapter = Chapter::factory()->createOne();

    Sanctum::actingAs(User::factory()->createOne());

    $data = [
        "comment" => "this is a test comment."
    ];

    $response = $this->post(route('api.chapter.comments.store', [
        "chapter" => $chapter->number,
        "series" => $chapter->series->id,
    ]), $data);

    $response->assertCreated();
    $response->assertJsonPath("data.comment", $data["comment"]);
    $this->assertTrue(ChapterComment::where('chapter_id', $chapter->id)->where('comment', $data["comment"])->exists());
});

test('user cannot store multiple comments in short periods', function () {
    $chapter = Chapter::factory()->createOne();

    $data = [
        "comment" => "this is a test comment."
    ];

    Sanctum::actingAs(User::factory()->createOne());

    $response = $this->post(route('api.chapter.comments.store', [
        "chapter" => $chapter->number,
        "series" => $chapter->series->id,
    ]), $data);

    $response->assertCreated();
    $response->assertJsonPath("data.comment", $data["comment"]);

    $response = $this->post(route('api.chapter.comments.store', [
        "chapter" => $chapter->number,
        "series" => $chapter->series->id,
    ]), $data);

    $response->assertTooManyRequests();
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
