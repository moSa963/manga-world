<?php

use App\Enums\UserPermission;
use App\Models\Chapter;
use App\Models\Series;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('admin can publish a chapter', function () {
    $admin = User::factory()->createOne(["admin" => true]);
    $series = Series::factory()->createOne(['published' => true]);
    $chapter = Chapter::factory()->createOne(['series_id' => $series->id, 'published' => false]);

    Sanctum::actingAs($admin);
    $response = $this->get(route("api.chapter.publish", ["series" => $series->id, "chapter" => $chapter->number]));
    $response->assertOk();
    $response->assertJsonPath('data.published', true);
});

test('user with "approve" permission can publish a chapter', function () {
    $user = User::factory()->createOne();
    $series = Series::factory()->createOne(['published' => true]);
    $chapter = Chapter::factory()->createOne(['series_id' => $series->id, 'published' => false]);
    $user->addPermission(UserPermission::APPROVE);

    Sanctum::actingAs($user);
    $response = $this->get(route("api.chapter.publish", ["series" => $series->id, "chapter" => $chapter->number]));

    $response->assertOk();
    $response->assertJsonPath('data.published', true);
});

test('user without "approve" permission cannot publish a chapter', function () {
    $user = User::factory()->createOne();
    $chapter = Chapter::factory()->createOne(['published' => false]);

    Sanctum::actingAs($user);

    $response = $this->get(route("api.chapter.publish", ["series" => $chapter->series->id, "chapter" => $chapter->number]));

    $response->assertNotFound();
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
