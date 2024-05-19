<?php

use App\Enums\UserPermission;
use App\Models\Chapter;
use App\Models\Series;
use App\Models\User;

test('chapter page can be rendered', function () {
    $chapter =  Chapter::factory()->createOne();

    $response = $this->get(route('chapter.show', ["series" => $chapter->series->id, "chapter" => $chapter->number]));

    $response->assertStatus(200);
});

test('create chapter page can be rendered', function () {
    $series =  Series::factory()->createOne();

    $user = User::factory()->createOne();

    $user->addPermission(UserPermission::CREATE);

    $response = $this->actingAs($user)->get(route('chapter.create', ["series" => $series->id]));

    $response->assertStatus(200);
});

test('create chapter page cannot be rendered for unauthorized users', function () {
    $series =  Series::factory()->createOne();

    $user = User::factory()->createOne();

    $response = $this->actingAs($user)->get(route('chapter.create', ["series" => $series->id]));

    $response->assertForbidden();
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
