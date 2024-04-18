<?php

use App\Enums\UserPermission;
use App\Models\Permission;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('admin can add new permission to a user', function () {
    $admin = User::factory()->createOne(["admin" => true]);
    $user = User::factory()->createOne();

    $this->assertFalse($user->hasAnyPermission(UserPermission::CREATE));

    Sanctum::actingAs($admin);

    $response = $this->post("/api/users/{$user->username}/permissions/create");

    $response->assertOk();

    $this->assertTrue($user->hasAnyPermission(UserPermission::CREATE));
});

test('admin can delete a permission from a user', function () {
    $admin = User::factory()->createOne(["admin" => true]);
    $user = User::factory()->createOne();

    $user->addPermission(UserPermission::CREATE);

    $this->assertTrue($user->hasAnyPermission(UserPermission::CREATE));

    Sanctum::actingAs($admin);

    $response = $this->delete("/api/users/{$user->username}/permissions/create");

    $response->assertOk();

    $this->assertFalse($user->hasAnyPermission(UserPermission::CREATE));
});
