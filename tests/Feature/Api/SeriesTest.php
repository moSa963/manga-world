<?php

use App\Enums\UserPermission as EnumsUserPermission;
use App\Models\Series;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;

test('user can get a list of series', function () {
    Series::factory(3)->create();
    Series::factory()->createOne(["published" => false]);

    $response = $this->get(route('api.series.list'));

    $response->assertSuccessful();

    $response->assertJsonCount(3, 'data');
});

test('user with "APPROVE" permission can get a list of series along with unpublished ones', function () {
    $user = User::factory()->createOne();

    $user->addPermission(EnumsUserPermission::APPROVE);

    Series::factory(3)->create(["published" => false]);

    Sanctum::actingAs($user);

    $response = $this->get(route('api.series.list'));

    $response->assertSuccessful();

    $response->assertJsonCount(3, 'data');
});

test('user can get a list of series along with unpublished ones that he created', function () {
    $user = User::factory()->createOne();

    Series::factory(3)->create(["published" => false, "user_id" => $user->id]);
    Series::factory(1)->create(["published" => false]);
    Series::factory(1)->create();

    Sanctum::actingAs($user);

    $response = $this->get(route('api.series.list'));

    $response->assertSuccessful();

    $response->assertJsonCount(4, 'data');
});

function getSeriesData()
{
    return  [
        "title" => "test title",
        "description" => "test description",
        "painter" => "test painter",
        "author" => "test author",
        "other_names" => ["name", "name2", "name3", "name4"],
        "type" => "manga",
        "status" => "ongoing",
        "release_date" => "25-04-2004",
        "poster" => UploadedFile::fake()->image("testImage.jpg"),
    ];
}

test('user with create permission can store a new series', function () {

    $user = User::factory()->createOne();

    $user->addPermission(EnumsUserPermission::CREATE);

    Sanctum::actingAs($user);

    $response = $this->post(route('api.series.store'), getSeriesData());

    $response->assertCreated();

    $series = Series::where("title", $response->decodeResponseJson()['data']['title'])->first();

    $this->assertTrue($series != null);
});

test('user without "create" permission cannot store a new series', function () {

    $user = User::factory()->createOne();

    Sanctum::actingAs($user);

    $response = $this->post(route('api.series.store'), getSeriesData());

    $response->assertForbidden();
});

afterEach(function () {
    $series = Series::all();

    foreach ($series as $s) {
        $s->delete();
    }
});
