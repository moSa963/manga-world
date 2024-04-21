<?php

use App\Enums\UserPermission;
use App\Models\Series;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('admin can publish a series', function () {
    $admin = User::factory()->createOne(["admin" => true]);
    $series = Series::factory()->createOne(['published' => false]);

    Sanctum::actingAs($admin);

    $response = $this->get(route("api.series.publish", ["series" => $series->id]));

    $response->assertOk();
    $response->assertJsonPath('data.published', true);
});

test('user with "approve" permission can publish a series', function () {
    $user = User::factory()->createOne();
    $series = Series::factory()->createOne(['published' => false]);

    $user->addPermission(UserPermission::APPROVE);

    Sanctum::actingAs($user);

    $response = $this->get(route("api.series.publish", ["series" => $series->id]));

    $response->assertOk();
    $response->assertJsonPath('data.published', true);
});

test('user without "approve" permission cannot publish a series', function () {
    $user = User::factory()->createOne();
    $series = Series::factory()->createOne(['published' => false]);

    Sanctum::actingAs($user);

    $response = $this->get(route("api.series.publish", ["series" => $series->id]));

    $response->assertForbidden();
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
