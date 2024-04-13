<?php

use App\Enums\UserPermission;
use App\Models\Chapter;
use App\Models\User;

test('series page can be rendered', function () {
    $chapter =  Chapter::factory()->createOne();

    $response = $this->get("/series/{$chapter->series->id}");

    $chapter->series->delete();

    $response->assertStatus(200);
});

test('create series page can be rendered if user has create permission', function () {
    $chapter =  Chapter::factory()->createOne();
    $user = User::factory()->createOne();

    $user->addPermission(UserPermission::CREATE);

    $response = $this->actingAs($user)->get("/series/new");

    $chapter->series->delete();

    $response->assertOk();
});

test('create series page cannot be rendered if user has no create permission', function () {
    $chapter =  Chapter::factory()->createOne();
    $user = User::factory()->createOne();

    $response = $this->actingAs($user)->get("/series/new");

    $chapter->series->delete();

    $response->assertForbidden();
});


test("list page can be rendered", function () {
    $response = $this->get('/series');

    $response->assertStatus(200);
});
