<?php

namespace Tests\Feature\Api;

use App\Models\Chapter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SeriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_can_get_a_list_of_series(): void
    {
        $user = User::factory()->createOne();

        $chapters = Chapter::factory(3)->create();

        Sanctum::actingAs($user);

        $response = $this->get('api/series');

        foreach ($chapters as $s) {
            $s->series->delete();
        }

        $response->assertSuccessful();

        $response->assertJsonCount(3, 'data');
    }
}
