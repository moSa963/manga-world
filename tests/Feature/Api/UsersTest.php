<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('admin can get list of users', function () {
    $admin = User::factory()->createOne(["admin" => true]);

    User::factory(4)->create();

    Sanctum::actingAs($admin);

    $response = $this->get('api/users');

    $response->assertOk();

    $response->assertJsonCount(5, "data");
});

test('admin can search for list of users', function () {
    $admin = User::factory()->createOne(["username" => "admin", "name" => "this admin", "admin" => true]);

    User::factory()->createOne(["username" => "usernameTest", "name" => "nameTest"]);
    User::factory()->createOne(["username" => "Testusername", "name" => "Testname"]);
    User::factory()->createOne(["username" => "username", "name" => "name"]);

    Sanctum::actingAs($admin);



    $response = $this->get('api/users?key=test');

    $response->assertOk();

    $response->assertJsonCount(2, "data");
});
