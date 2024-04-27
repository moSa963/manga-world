<?php

use App\Models\User;

test('administration users page is displayed', function () {
    $user = User::factory()->createOne(["admin" => true]);

    $response = $this
        ->actingAs($user)
        ->get(route("admin.users.list"));

    $response->assertOk();
});

test('unauthorized users can not access administration users page', function () {
    $user = User::factory()->createOne(["admin" => false]);

    $response = $this
        ->actingAs($user)
        ->get(route("admin.users.list"));

    $response->assertNotFound();
});
