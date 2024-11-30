<?php

use App\Models\Chapter;
use App\Models\Series;
use App\Models\User;
use App\Services\StoragePathService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;

use function PHPUnit\Framework\assertTrue;

test('user can add a new chapter', function () {
    $series = Series::factory()->createOne();
    $user = User::factory()->createOne(['admin' => true]);

    Sanctum::actingAs($user);

    $response = $this->post("api/series/{$series->id}/chapters", [
        "number" => 1,
        "title" => "test chapter title",
        "release_date" => "2024-11-30",
        'pages' => [
            UploadedFile::fake()->image('page1.jpg'),
            UploadedFile::fake()->image('page2.jpg'),
            UploadedFile::fake()->image('page3.jpg'),
            UploadedFile::fake()->image('page4.jpg'),
        ],
    ]);

    $response->assertSuccessful();

    $chapter = Chapter::where('id', $response->decodeResponseJson()["data"]['id'])->first();

    assertTrue($chapter != null);

    $pages = $chapter->pages()->get();

    assertTrue($pages->count() === 4);

    foreach ($pages as $page) {
        assertTrue(Storage::exists(StoragePathService::forPage($chapter) . "/{$page->name}"));
    }
});

test('unauthorized user cannot add a new chapter', function () {
    $series = Series::factory()->createOne();
    $user = User::factory()->createOne(['admin' => false]);

    Sanctum::actingAs($user);

    $response = $this->post("api/series/{$series->id}/chapters", [
        "number" => 1,
        "title" => "test chapter title",
        "release_date" => "5/15/2025",
        'pages' => [
            UploadedFile::fake()->image('page1.jpg'),
        ],
    ]);
    $response->assertForbidden();
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
