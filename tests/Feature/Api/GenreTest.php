<?php

use App\Models\Genre;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

use function PHPUnit\Framework\assertTrue;

test('user can get list of genres', function () {
    Genre::create(['name' => 'newGenre1']);
    Genre::create(['name' => 'newGenre2']);
    Genre::create(['name' => 'newGenre3']);
    Genre::create(['name' => 'newGenre4']);

    $response = $this->get(route("api.genres.list"));

    $response->assertOk();

    $response->assertJsonCount(4);
});

test('admin can add new genre', function () {
    $user = User::factory()->create(["admin" => true]);
    Sanctum::actingAs($user);

    $response = $this->post(route("api.genres.store", ["name" => "newGenre"]));

    $response->assertOk();

    assertTrue(Genre::where('name', 'newGenre')->exists());
});

test('admin can delete new genre', function () {
    $user = User::factory()->create(["admin" => true]);
    Sanctum::actingAs($user);

    Genre::create(['name' => 'newGenre']);
    $response = $this->delete(route("api.genres.delete", ["genre" => "newGenre"]));

    $response->assertOk();
    assertTrue(!Genre::where('name', 'newGenre')->exists());
});

test('users without permission cannot add new genre', function () {
    $user = User::factory()->create(["admin" => false]);
    Sanctum::actingAs($user);

    $response = $this->post(route("api.genres.store", ["name" => "newGenre"]));

    $response->assertForbidden();

    assertTrue(!Genre::where('name', 'newGenre')->exists());
});

beforeEach(function () {
    Genre::query()->delete();
});
