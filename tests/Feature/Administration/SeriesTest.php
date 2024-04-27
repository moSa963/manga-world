<?php

use App\Models\User;

test('administration series page is displayed', function () {
    $user = User::factory()->createOne(["admin" => true]);

    $response = $this
        ->actingAs($user)
        ->get(route("admin.series.list"));

    $response->assertOk();
});

test('unauthorized users can not access administration series page', function () {
    $user = User::factory()->createOne(["admin" => false]);

    $response = $this
        ->actingAs($user)
        ->get(route("admin.series.list"));

    $response->assertNotFound();
});
