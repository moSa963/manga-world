<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('user can get his information', function () {
    $user = User::factory()->createOne();

    Sanctum::actingAs($user);

    $response = $this->get('/api/user');

    $response->assertStatus(200);
    $response->assertJsonPath("username", $user->username);
});

test('user can login', function () {
    $user = User::factory()->createOne();

    $response = $this->post('/api/login', [
        "username" => $user->username,
        "password" => "password"
    ]);

    $response->assertStatus(200);
    $response->assertJsonPath("data.user.username", $user->username);

    $response = $this->withToken($response->decodeResponseJson()["data"]["token"])->get("/api/user");

    $response->assertJsonPath("username", $user->username);
    $response->assertOk();
});

test('user can register', function () {

    $response = $this->post('/api/register', [
        "name" => "test name",
        "username" => "testUsername",
        "email" => "email@test.com",
        "password" => "password",
        "password_confirmation" => "password",
    ]);

    $response->assertStatus(200);
    $response->assertJsonPath("data.user.username", "testUsername");

    $response = $this->withToken($response->decodeResponseJson()["data"]["token"])->get("/api/user");

    $response->assertJsonPath("username", "testUsername");
    $response->assertOk();
});
